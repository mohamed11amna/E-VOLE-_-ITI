<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GenerateMarketResearchJob implements ShouldQueue
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
            $promptInstruction = "You are an expert marketing strategist. I will give you a product description. Please generate market research for this product. 
Return exactly in this JSON structure, with NO markdown formatting, just pure JSON:
{
  \"seo_keywords\": [\"keyword1\", \"keyword2\", \"keyword3\", \"keyword4\", \"keyword5\"],
  \"target_demographics\": \"Summary of target audience\",
  \"competitor_strategy\": \"Summary of likely competitor strategies\",
  \"ad_copy\": {
    \"facebook\": \"Facebook ad copy here\",
    \"instagram\": \"Instagram ad copy here\",
    \"tiktok\": \"TikTok ad idea/copy here\"
  }
}

Product Description: " . $this->campaign->description;

            $apiKey = env('GEMINI_API_KEY');
            if (!$apiKey) {
                Log::error('GEMINI_API_KEY is missing from .env');
                return;
            }

            $response = Http::withoutVerifying()->timeout(120)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $promptInstruction]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $extractedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                
                // Clean up any markdown blocks if returned
                $extractedText = str_replace(['```json', '```'], '', $extractedText);
                
                $this->campaign->update([
                    'market_research' => json_decode(trim($extractedText), true) ?? ['error' => 'Failed to parse JSON', 'raw' => $extractedText]
                ]);
                
                Log::info("Market research generated for Campaign {$this->campaign->id}");
            } else {
                Log::error("Gemini API Error (Market Research): " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("GenerateMarketResearchJob failed: " . $e->getMessage());
        }
    }
}
