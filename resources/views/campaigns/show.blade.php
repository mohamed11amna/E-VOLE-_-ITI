<x-app-layout>
    @if($campaign->status === 'analyzing' || $campaign->status === 'processing')
        <meta http-equiv="refresh" content="5">
    @endif

    <div class="pt-10 pb-section-gap min-h-screen">
        @if(session('success'))
            <div class="mb-8 max-w-4xl rounded-xl border border-secondary/20 bg-secondary-container/30 p-4 text-sm text-on-secondary-container font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Editorial Header -->
        <header class="mb-organic-offset flex flex-col items-start max-w-4xl">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('campaigns.index') }}" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors flex items-center gap-1 border-r border-outline-variant/30 pr-3">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                </a>
                <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">Project Review</span>
                
                @php
                    $statusConfig = match($campaign->status) {
                        'completed' => ['colorClass' => 'chip-completed', 'label' => 'Completed'],
                        'processing' => ['colorClass' => 'chip-processing', 'label' => 'Processing'],
                        'pending_approval' => ['colorClass' => 'chip-processing', 'label' => 'Pending Approval'],
                        'analyzing' => ['colorClass' => 'chip-processing', 'label' => 'Analyzing'],
                        default => ['colorClass' => 'chip-draft', 'label' => 'Draft'],
                    };
                @endphp
                <span class="chip {{ $statusConfig['colorClass'] }} font-label-caps text-[10px] ml-2">
                    {{ $statusConfig['label'] }}
                </span>
            </div>
            
            <h1 class="font-display-lg text-display-lg text-primary mb-6 md:text-[64px] text-headline-lg-mobile font-headline-lg-mobile md:font-display-lg">
                {{ $campaign->title }}
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                {{ $campaign->description }}
            </p>
        </header>

        <!-- Asymmetrical Editorial Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-section-gap items-start mt-12 relative">
            
            <!-- Left Side: Large Primary Area (7 Columns) -->
            <div class="lg:col-span-7 relative z-10 space-y-12">
                @if($campaign->status === 'completed' && $campaign->final_image_url)
                    <!-- Main Image Card -->
                    <article class="bg-surface-container-lowest rounded-xl p-6 md:p-8 diffused-shadow border border-outline-variant/10 relative">
                        <div class="absolute top-4 -left-4 w-full h-full bg-surface-container-low rounded-xl -z-10"></div>
                        
                        <div class="relative w-full aspect-[4/5] rounded-lg overflow-hidden bg-surface-container mb-6 group">
                            <img class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-105" src="{{ asset($campaign->final_image_url) }}" alt="{{ $campaign->title }} Final Ad" />
                            
                            <div class="absolute bottom-4 left-4 bg-surface/90 backdrop-blur-md rounded-full px-4 py-2 flex items-center gap-2 border border-outline-variant/20 shadow-sm">
                                <span class="material-symbols-outlined text-secondary" style="font-size: 16px;">auto_awesome</span>
                                <span class="font-label-caps text-label-caps text-primary">Final_Render.png</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between px-2">
                            <div class="max-w-[70%]">
                                <h3 class="font-title-lg text-title-lg text-primary">Key Visual: Hero Placements</h3>
                                <p class="font-body-md text-body-md text-on-surface-variant mt-1 line-clamp-2">{{ $campaign->ad_caption ?? 'Generated at 8K resolution. Color graded for print & digital OHH.' }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="document.getElementById('feedback-form-{{$campaign->id}}').classList.toggle('hidden')" class="w-10 h-10 rounded-full flex items-center justify-center border border-outline-variant/30 text-primary hover:bg-surface-container transition-colors" title="Request Change">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                            </div>
                        </div>

                        <!-- Feedback Form -->
                        <form id="feedback-form-{{$campaign->id}}" action="{{ route('media.feedback', $campaign->id) }}" method="POST" class="hidden mt-6 pt-6 border-t border-outline-variant/20 w-full animate-fade-in">
                            @csrf
                            <label class="font-label-caps text-label-caps text-primary mb-2 block uppercase tracking-widest">Request a Change</label>
                            <textarea name="feedback" rows="2" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-secondary resize-none text-primary placeholder:text-on-surface-variant/50 transition-colors" placeholder="e.g. Make the lighting darker, add more contrast..." required></textarea>
                            <button type="submit" class="bg-primary text-on-primary font-body-md px-6 py-3 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm flex items-center justify-center gap-2 mt-4 w-full md:w-auto">
                                <span class="material-symbols-outlined text-sm">refresh</span>
                                Regenerate AI Prompt
                            </button>
                        </form>
                    </article>
                @elseif($campaign->status === 'analyzing' || $campaign->status === 'processing')
                    <article class="bg-surface-container-lowest rounded-xl p-12 diffused-shadow border border-outline-variant/10 text-center flex flex-col items-center justify-center min-h-[500px]">
                        <span class="grid h-20 w-20 place-items-center rounded-full bg-secondary-container mb-6 animate-pulse">
                            <span class="material-symbols-outlined text-[40px] text-on-secondary-container">hourglass_empty</span>
                        </span>
                        <h3 class="font-headline-lg text-headline-lg text-primary">Intelligence Processing...</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-4 max-w-sm">The multi-stage AI pipeline is orchestrating your assets. This typically takes around 40 seconds.</p>
                    </article>
                @elseif($campaign->status === 'pending_approval')
                    <article class="bg-surface-container-lowest rounded-xl p-8 diffused-shadow border border-outline-variant/10">
                        <header class="mb-6 border-b border-outline-variant/20 pb-4">
                            <h3 class="font-title-lg text-title-lg text-primary flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary">draw</span>
                                Review AI Generative Prompt
                            </h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mt-2">Stage 1 has successfully analyzed your product. Review the cinematic scene before generating the final image.</p>
                        </header>
                        <form action="{{ route('campaigns.approve_generation', $campaign->id) }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-3 mb-8">
                                <label class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest">Cinematic Scene Prompt</label>
                                <textarea name="image_prompt" rows="6" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl p-5 text-sm focus:outline-none focus:border-secondary resize-y text-primary leading-relaxed transition-colors">{{ $campaign->generated_image_prompt }}</textarea>
                                <p class="text-xs text-on-surface-variant mt-1 opacity-70">Feel free to tweak the prompt before giving the final green light.</p>
                            </div>
                            <div class="flex justify-end pt-4 border-t border-outline-variant/20">
                                <button type="submit" class="bg-primary text-on-primary font-body-md px-8 py-3 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                                    Approve & Render
                                </button>
                            </div>
                        </form>
                    </article>
                @else
                    <article class="bg-surface-container-lowest rounded-xl p-12 diffused-shadow border border-outline-variant/10 text-center flex flex-col items-center justify-center min-h-[300px]">
                        <span class="grid h-16 w-16 place-items-center rounded-full bg-error-container mb-5">
                            <span class="material-symbols-outlined text-[32px] text-error">error</span>
                        </span>
                        <h3 class="font-title-lg text-title-lg text-primary">Generation Failed</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-sm">The pipeline encountered an anomaly.</p>
                    </article>
                @endif

                <!-- Uploaded Source Media -->
                @php
                    $uploadedImages = $campaign->mediaAssets->where('type', 'image');
                @endphp
                @if($uploadedImages->count() > 0)
                    <div>
                        <h3 class="font-label-caps text-label-caps text-primary uppercase tracking-widest mb-6 border-b border-outline-variant/20 pb-2">Source Materials</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($uploadedImages as $img)
                                <div class="bg-surface-container rounded-lg overflow-hidden border border-outline-variant/10 aspect-square">
                                    <img src="{{ asset('storage/' . $img->content) }}" class="w-full h-full object-cover mix-blend-multiply opacity-90 transition-transform duration-500 hover:scale-105" alt="Source">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Side: Market Intel & Copy Modules (5 Columns) -->
            <div class="lg:col-span-5 flex flex-col gap-organic-offset relative lg:pt-16">
                @if($campaign->market_research)
                    <!-- Module 1: Market Intel -->
                    <section class="bg-surface-container-low rounded-xl p-8 diffused-shadow relative overflow-hidden group border border-outline-variant/5">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform duration-700 group-hover:scale-150"></div>
                        <header class="flex items-center justify-between mb-6 border-b border-outline-variant/20 pb-4">
                            <h2 class="font-headline-lg text-headline-lg text-primary">Market Intel</h2>
                            <span class="material-symbols-outlined text-secondary">bar_chart</span>
                        </header>
                        <div class="space-y-6">
                            <div>
                                <span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest block mb-2">Target Demographic</span>
                                <p class="font-title-lg text-title-lg text-primary leading-tight">{{ $campaign->market_research['target_demographics'] ?? 'N/A' }}</p>
                            </div>
                            <div class="pt-4 border-t border-outline-variant/10">
                                <span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest block mb-2">Competitor Strategy</span>
                                <p class="font-body-md text-body-md text-primary leading-relaxed">{{ $campaign->market_research['competitor_strategy'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Module 2: Generative Copy -->
                    <section class="bg-surface-container-lowest rounded-xl p-8 diffused-shadow border border-outline-variant/10">
                        <header class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-secondary">text_fields</span>
                            <h2 class="font-title-lg text-title-lg text-primary">Generative Copy</h2>
                        </header>
                        <form action="{{ route('campaigns.update_text', $campaign->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                @if(isset($campaign->market_research['ad_copy']['facebook']))
                                    <div class="group relative bg-surface p-5 rounded-lg border border-transparent hover:border-outline-variant/30 transition-colors focus-within:border-secondary/50">
                                        <span class="font-label-caps text-label-caps text-secondary mb-2 block">Variant A (Facebook)</span>
                                        <textarea name="ad_copy[facebook]" rows="4" class="w-full bg-transparent border-none p-0 focus:ring-0 font-body-lg text-body-lg text-primary italic resize-none">{{ $campaign->market_research['ad_copy']['facebook'] }}</textarea>
                                    </div>
                                @endif
                                @if(isset($campaign->market_research['ad_copy']['instagram']))
                                    <div class="group relative bg-surface p-5 rounded-lg border border-transparent hover:border-outline-variant/30 transition-colors focus-within:border-secondary/50">
                                        <span class="font-label-caps text-label-caps text-on-surface-variant mb-2 block">Variant B (Instagram)</span>
                                        <textarea name="ad_copy[instagram]" rows="4" class="w-full bg-transparent border-none p-0 focus:ring-0 font-body-lg text-body-lg text-primary italic resize-none">{{ $campaign->market_research['ad_copy']['instagram'] }}</textarea>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="px-6 py-2 rounded-full border border-primary text-primary font-body-md hover:bg-surface-container transition-colors text-sm">
                                    Save Edits
                                </button>
                            </div>
                        </form>
                    </section>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
