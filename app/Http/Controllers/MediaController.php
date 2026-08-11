<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class MediaController extends Controller
{
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $campaign = Campaign::findOrFail($id);

        // 1. Append feedback to the user_scenario
        $currentScenario = $campaign->user_scenario ?? '';
        $campaign->user_scenario = $currentScenario . "\n[User Feedback for Revision]: " . $request->feedback;
        $campaign->status = 'analyzing';
        $campaign->save();

        // 2. Clear old generated media (we no longer use mediaAssets for generated images, it's final_image_url)
        $campaign->final_image_url = null;
        $campaign->save();

        // 3. Re-dispatch the Image Prompt generation job

        \App\Jobs\GenerateImagePromptJob::dispatch($campaign);
        
        return redirect()->back()->with('success', 'Feedback submitted! The AI is regenerating your assets based on your exact adjustments.');
    }
}
