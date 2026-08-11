<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateFinalAdImageJob implements ShouldQueue
{
    use Queueable;

    public $campaign;
    public $timeout = 300; 

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle(): void
    {
        try {
            Log::info("Starting Stage 2: Final Ad Image Generation for Campaign {$this->campaign->id}");

            $mediaAssets = $this->campaign->mediaAssets()->where('type', 'image')->get();
            if ($mediaAssets->isEmpty()) {
                Log::error("No images found for Campaign {$this->campaign->id} in Stage 2");
                $this->campaign->update(['status' => 'failed']);
                return;
            }

            $sourceAsset = $mediaAssets->first();
            $sourcePath = Storage::disk('public')->path(str_replace('storage/', '', $sourceAsset->content));

            if (!file_exists($sourcePath)) {
                Log::error("Source image not found: {$sourcePath}");
                $this->campaign->update(['status' => 'failed']);
                return;
            }

            $this->campaign->update(['status' => 'processing']);

            // Full original prompt
            $prompt = $this->campaign->generated_image_prompt ?? 'Product placed in a modern setting';
            $productDescription = $this->campaign->description ?? '';
            
            // Enrich prompt for pure generative models
            $enrichedPrompt = "Professional product photography ad. Product: {$productDescription}. Scene: {$prompt}";

            // 1. Upload directly to LightX's S3 bucket (they block third-party hosts like Catbox)
            $imageUrl = $this->uploadToLightX($sourcePath);
            if ($imageUrl) {
                Log::info("Product image uploaded to LightX S3: {$imageUrl}");
            } else {
                Log::error("Failed to upload image to LightX. Proceeding with pure generative prompt as fallback.");
            }

            // Call LightX API
            $imageBinary = $this->callLightX($imageUrl, $enrichedPrompt);

            if ($imageBinary) {
                $outputFilename = 'campaigns/ad_image_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($outputFilename, $imageBinary);

                $this->campaign->update([
                    'final_image_url' => 'storage/' . $outputFilename,
                    'status' => 'completed'
                ]);
                Log::info("Stage 2 completed successfully for Campaign {$this->campaign->id}");
            } else {
                Log::error("LightX generation failed for Campaign {$this->campaign->id}");
                $this->campaign->update(['status' => 'failed']);
            }

        } catch (\Exception $e) {
            Log::error("GenerateFinalAdImageJob failed: " . $e->getMessage());
            $this->campaign->update(['status' => 'failed']);
        }
    }

    /**
     * Upload directly to LightX's S3 bucket using their v2 API
     */
    private function uploadToLightX($filePath)
    {
        try {
            $apiKey = env('LIGHTX_API_KEY');
            if (!$apiKey) return null;

            $fileSize = filesize($filePath);
            
            // Step 1: Get presigned URL
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'x-api-key' => $apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.lightxeditor.com/external/api/v2/uploadImageUrl', [
                    'uploadType' => 'imageUrl',
                    'size' => $fileSize,
                    'contentType' => 'image/jpeg'
                ]);

            if (!$response->successful()) {
                Log::error("LightX presigned URL failed: " . $response->body());
                return null;
            }

            $data = $response->json();
            $uploadUrl = $data['body']['uploadImage'] ?? null;
            $finalUrl = $data['body']['imageUrl'] ?? null;

            if (!$uploadUrl || !$finalUrl) return null;

            // Step 2: PUT file to S3
            $fileContent = file_get_contents($filePath);
            
            $putResponse = Http::withoutVerifying()
                ->withBody($fileContent, 'image/jpeg')
                ->send('PUT', $uploadUrl, [
                    'headers' => [
                        'Content-Type' => 'image/jpeg',
                        'Content-Length' => $fileSize
                    ]
                ]);

            if ($putResponse->successful()) {
                return $finalUrl;
            } else {
                Log::error("LightX S3 PUT failed: " . $putResponse->body());
            }

        } catch (\Exception $e) {
            Log::warning("LightX upload exception: " . $e->getMessage());
        }
        return null;
    }

    /**
     * LightX API v2 - Image to Image (Async Polling)
     */
    private function callLightX($imageUrl, $prompt)
    {
        try {
            $apiKey = env('LIGHTX_API_KEY');
            if (!$apiKey) {
                throw new \Exception("LIGHTX_API_KEY not configured in .env");
            }

            Log::info("Calling LightX API v2...");

            $payload = [
                'textPrompt' => $prompt
            ];

            if ($imageUrl) {
                $payload['imageUrl'] = $imageUrl;
            }

            $endpoint = $imageUrl ? 'https://api.lightxeditor.com/external/api/v2/image2image' : 'https://api.lightxeditor.com/external/api/v2/text2image';

            $response = Http::withoutVerifying()
                ->timeout(60) 
                ->withHeaders([
                    'x-api-key' => $apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->post($endpoint, $payload);

            if (!$response->successful()) {
                Log::error("LightX API v2 Error ({$response->status()}): " . $response->body());
                return null;
            }

            // Fix for LightX API response parsing
            $data = json_decode($response->body(), true);
            
            // Check if it's synchronous and returned an image directly
            $directUrl = $data['body']['data'] ?? $data['data'] ?? $data['imageUrl'] ?? $data['body']['output'] ?? $data['output'] ?? null;
            if (is_string($data['body'] ?? null) && str_starts_with($data['body'], 'http')) {
                $directUrl = $data['body'];
            }
            if ($directUrl && is_string($directUrl) && str_starts_with($directUrl, 'http')) {
                $imageData = Http::withoutVerifying()->get($directUrl)->body();
                if ($imageData && strlen($imageData) > 1000) return $imageData;
            }

            // Extract orderId for async polling
            $orderId = $data['body']['orderId'] ?? $data['orderId'] ?? null;
            
            if (!$orderId) {
                Log::error("LightX Response missing orderId and imageUrl: " . $response->body());
                return null;
            }

            Log::info("LightX API returned orderId: {$orderId}. Starting polling...");

            // Poll for status
            $maxRetries = 20;
            $sleepSeconds = 3;

            for ($i = 0; $i < $maxRetries; $i++) {
                sleep($sleepSeconds);
                
                $pollResponse = Http::withoutVerifying()
                    ->withHeaders([
                        'x-api-key' => $apiKey,
                        'Content-Type' => 'application/json'
                    ])
                    ->post('https://api.lightxeditor.com/external/api/v2/order-status', [
                        'orderId' => $orderId
                    ]);

                if ($pollResponse->successful()) {
                    $pollData = $pollResponse->json();
                    
                    // Possible locations for status and result URL
                    $status = $pollData['body']['status'] ?? $pollData['status'] ?? null;
                    $resultUrl = $pollData['body']['output'] ?? $pollData['output'] ?? $pollData['body']['imageUrl'] ?? $pollData['imageUrl'] ?? null;
                    
                    
                    if (is_string($resultUrl) && str_starts_with($resultUrl, 'http')) {
                        Log::info("LightX processing complete. Downloading result...");
                        $imageData = Http::withoutVerifying()->get($resultUrl)->body();
                        if ($imageData && strlen($imageData) > 1000) {
                            return $imageData;
                        }
                    }
                    
                    // If status indicates failure
                    if (in_array($status, [5, 'failed', 'error', 'canceled'])) {
                        Log::error("LightX processing failed for orderId {$orderId}. Response: " . $pollResponse->body());
                        return null;
                    }
                } else {
                    Log::warning("LightX poll error: " . $pollResponse->body());
                }
            }
            
            Log::error("LightX API polling timed out for orderId: {$orderId}");

        } catch (\Exception $e) {
            Log::error("LightX exception: " . $e->getMessage());
        }
        return null;
    }
}
