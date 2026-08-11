<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateImagePromptJob implements ShouldQueue
{
    use Queueable;

    public $campaign;

    /**
     * Create a new job instance.
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $mediaAssets = $this->campaign->mediaAssets()->where('type', 'image')->get();
            if ($mediaAssets->isEmpty()) {
                Log::warning("No images found for Campaign {$this->campaign->id} in Stage 1");
                return;
            }

            $productDescription = $this->campaign->description ?? 'A product';
            $userScenario = $this->campaign->user_scenario ? "The user's desired ad scenario/scene: '{$this->campaign->user_scenario}'." : "";
            
            $marketResearch = $this->campaign->market_research ?? [];
            $targetDemographic = $marketResearch['target_demographics'] ?? 'general audience';
            $competitorStrategy = $marketResearch['competitor_strategy'] ?? '';
            
            $promptInstruction = "You are an Expert Ad Prompt Engineer specializing in high-fidelity image generation models. Analyze this product photo and the following inputs:
1. Product Metadata: '{$productDescription}'
2. User Scenario: '{$userScenario}'
3. Market Research Context: Target demographic is {$targetDemographic}. Competitor strategy: {$competitorStrategy}.

STRICT EXTRACTION RULE: You must output a valid JSON object representing the textual prompt structure extracted from the image. Do NOT attempt to output a direct image generation output.

The JSON must have exactly two keys:
1. 'image_prompt': Write a highly detailed, single-paragraph prompt for a premium studio product photograph. 
   - MENTAL FRAMEWORK: You must mentally build this scene using 5 layers (Subject, Environment, Lighting, Negative Space, Color/Mood), but DO NOT include the literal bracketed layer names (e.g., do not write '[Subject Anchor]') in the final output. The result must be one seamless, flowing paragraph.
   - TEXT EXTRACTION (CRITICAL): You must read any visible text, branding, or logos on the product in the provided image. Integrate this text explicitly into your description using quotation marks and typography descriptions (e.g., The bottle features a label with the exact text \"Dashing Blue\" printed in bold, white sans-serif typography...).
   - OPTICS: You must use professional photography terminology (e.g., 'macro shot', 'f/2.8 aperture', 'cinematic lighting').
   - LAYOUT: You must include instructions for open negative space (top or bottom) for advertising text overlays.

2. 'ad_caption': Write a short, powerful 3-to-4 word marketing headline suitable for an ad poster based on the product's vibe and market context.

Return ONLY valid JSON. Do not include markdown code blocks.";

            $parts = [
                ['text' => $promptInstruction]
            ];

            foreach ($mediaAssets as $asset) {
                $path = Storage::disk('public')->path(str_replace('storage/', '', $asset->content));
                if (file_exists($path)) {
                    $mimeType = mime_content_type($path);
                    $base64Image = base64_encode(file_get_contents($path));
                    
                    $parts[] = [
                        'inlineData' => [
                            'mimeType' => $mimeType,
                            'data' => $base64Image
                        ]
                    ];
                }
            }

            $apiKey = env('GEMINI_API_KEY');
            if (!$apiKey) {
                Log::error('GEMINI_API_KEY is missing from .env');
                return;
            }

            Log::info("Sending Stage 1 Vision Analysis for Campaign {$this->campaign->id}");
            
            $response = Http::withoutVerifying()->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => $parts
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $extractedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                
                // Clean up any markdown blocks if returned
                $extractedText = str_replace(['```json', '```'], '', trim($extractedText));
                
                $data = json_decode($extractedText, true);

                if (is_array($data)) {
                    // Database Rule: structural splits must be ksorted A to Z
                    ksort($data);
                    
                    $imagePrompt = $data['image_prompt'] ?? '';
                    if (is_array($imagePrompt)) {
                        ksort($imagePrompt);
                        $imagePrompt = json_encode($imagePrompt);
                    }
                    
                    $adCaption = $data['ad_caption'] ?? '';
                    
                    $this->campaign->update([
                        'generated_image_prompt' => $imagePrompt,
                        'ad_caption' => $adCaption,
                        'status' => 'pending_approval'
                    ]);
                    
                    Log::info("Stage 1 Vision Analysis successful for Campaign {$this->campaign->id}. Waiting for user approval.");
                } else {
                    Log::error("Failed to parse Gemini JSON output for Campaign {$this->campaign->id}");
                }
            } else {
                Log::error("Gemini API Error: " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("GenerateImagePromptJob failed: " . $e->getMessage());
        }
    }
}
