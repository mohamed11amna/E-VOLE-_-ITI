<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = \Illuminate\Support\Facades\Auth::user()->campaigns()->latest()->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function library()
    {
        $campaigns = \Illuminate\Support\Facades\Auth::user()->campaigns()
            ->whereNotNull('final_image_url')
            ->latest()
            ->paginate(12);
            
        return view('library.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_scenario' => 'nullable|string',
            'product_images' => 'required|array|min:1|max:5',
            'product_images.*' => 'image|max:10240', // 10MB max per image
        ]);

        // Create the campaign in the database
        $campaign = \Illuminate\Support\Facades\Auth::user()->campaigns()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_scenario' => $request->user_scenario,
            'status' => 'analyzing', // Phase 2 extracts prompt
        ]);

        // Save multiple images to local storage and database
        foreach ($request->file('product_images') as $imageFile) {
            $imagePath = $imageFile->store('campaigns', 'public');
            $campaign->mediaAssets()->create([
                'type' => 'image',
                'content' => $imagePath,
                'status' => 'uploaded'
            ]);
        }

        // Dispatch background jobs sequentially
        \Illuminate\Support\Facades\Bus::chain([
            new \App\Jobs\GenerateMarketResearchJob($campaign),
            new \App\Jobs\GenerateImagePromptJob($campaign)
        ])->dispatch();

        return redirect()->route('campaigns.show', $campaign->id)
                         ->with('success', 'Campaign created successfully! The AI is analyzing your image.');
    }

    public function show($id)
    {
        $campaign = \Illuminate\Support\Facades\Auth::user()->campaigns()->with('mediaAssets')->findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }

    public function media($id)
    {
        $campaign = \Illuminate\Support\Facades\Auth::user()->campaigns()->with('mediaAssets')->findOrFail($id);
        return view('campaigns.media', compact('campaign'));
    }

    public function updateText(Request $request, $id)
    {
        $campaign = \Illuminate\Support\Facades\Auth::user()->campaigns()->findOrFail($id);
        
        $request->validate([
            'ad_copy' => 'required|array'
        ]);

        $mr = $campaign->market_research;
        if (isset($mr['ad_copy'])) {
            $mr['ad_copy'] = array_merge($mr['ad_copy'], $request->ad_copy);
            $campaign->market_research = $mr;
            $campaign->save();
        }

        return redirect()->back()->with('success', 'Ad Copy tweaks saved successfully!');
    }

    public function approveGeneration(Request $request, $id)
    {
        $campaign = \Illuminate\Support\Facades\Auth::user()->campaigns()->findOrFail($id);
        
        $request->validate([
            'image_prompt' => 'required|string'
        ]);

        $campaign->update([
            'generated_image_prompt' => $request->image_prompt,
            'status' => 'processing'
        ]);

        \App\Jobs\GenerateFinalAdImageJob::dispatch($campaign);

        return redirect()->back()->with('success', 'Prompt approved! Generating final ad image...');
    }
}
