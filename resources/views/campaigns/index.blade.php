<x-app-layout>
    <!-- Header Section -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8 mb-organic-offset">
        <div class="flex flex-col gap-4 max-w-2xl">
            <p class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-[0.1em]">Campaign Horizon</p>
            <h1 class="font-display-lg text-display-lg text-primary md:hidden font-headline-lg-mobile text-headline-lg-mobile">Overview</h1>
            <h1 class="font-display-lg text-display-lg text-primary hidden md:block">Overview</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-2 max-w-xl">
                Review and orchestrate your active initiatives. The fluid elegantly tracks progress across all channels.
                <br><span class="text-sm opacity-70">{{ $campaigns->count() }} campaigns · {{ $campaigns->where('status', 'processing')->count() }} rendering right now</span>
            </p>
        </div>
        <div class="flex gap-4 items-center shrink-0">
            <button class="flex items-center gap-2 px-6 py-3 rounded-full border border-primary/20 text-primary font-body-md text-body-md hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter
            </button>
            <a href="{{ route('campaigns.create') }}" class="md:hidden flex items-center justify-center px-6 py-3 rounded-full bg-primary text-on-primary font-body-md text-body-md hover:bg-secondary transition-colors duration-300">
                New Campaign
            </a>
        </div>
    </header>

    @if($campaigns->isEmpty())
        <div class="glass-panel mt-12 flex flex-col items-center justify-center rounded-xl py-20 text-center">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-6 opacity-50">auto_awesome</span>
            <h3 class="font-headline-lg text-headline-lg text-primary mb-2">No campaigns yet</h3>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-md">Create your first campaign to start generating studio-grade AI ad creatives.</p>
            <a href="{{ route('campaigns.create') }}" class="mt-8 flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-primary text-on-primary font-body-lg text-body-lg hover:bg-secondary transition-colors shadow-sm">
                <span class="material-symbols-outlined">add</span> New Campaign
            </a>
        </div>
    @else
        <!-- Campaign Stack -->
        <div class="flex flex-col gap-6 mt-8">
            @foreach($campaigns as $campaign)
                @php
                    $statusConfig = match($campaign->status) {
                        'completed' => ['icon' => 'check_circle', 'colorClass' => 'chip-completed', 'label' => 'Completed'],
                        'processing' => ['icon' => 'sync', 'colorClass' => 'chip-processing', 'label' => 'Processing'],
                        'pending_approval' => ['icon' => 'draw', 'colorClass' => 'chip-processing', 'label' => 'Pending'],
                        'analyzing' => ['icon' => 'hourglass_empty', 'colorClass' => 'chip-processing', 'label' => 'Analyzing'],
                        default => ['icon' => 'edit_document', 'colorClass' => 'chip-draft', 'label' => 'Draft'],
                    };

                    $bgImage = null;
                    if ($campaign->final_image_url) {
                        $bgImage = asset($campaign->final_image_url);
                    } elseif ($campaign->mediaAssets->first()) {
                        $bgImage = asset('storage/' . $campaign->mediaAssets->first()->content);
                    }
                @endphp
                
                <article class="campaign-card glass-panel rounded-xl p-8 md:p-10 flex flex-col md:flex-row gap-8 items-start md:items-center justify-between relative overflow-hidden group">
                    @if($bgImage)
                        <!-- Abstract visual element inside card -->
                        <div class="absolute right-0 top-0 bottom-0 w-[40%] bg-cover bg-center opacity-10 group-hover:opacity-30 transition-opacity duration-700 mix-blend-multiply" style="background-image: url('{{ $bgImage }}')"></div>
                        <div class="absolute right-0 top-0 bottom-0 w-[40%] bg-gradient-to-r from-background to-transparent pointer-events-none"></div>
                    @endif
                    
                    <div class="flex flex-col gap-4 z-10 w-full md:w-auto">
                        <div class="flex items-center gap-3">
                            <span class="chip {{ $statusConfig['colorClass'] }} font-label-caps text-label-caps">
                                <span class="material-symbols-outlined text-[14px]">{{ $statusConfig['icon'] }}</span>
                                {{ $statusConfig['label'] }}
                            </span>
                            <span class="font-body-md text-body-md text-on-surface-variant">Last updated {{ $campaign->updated_at->diffForHumans() }}</span>
                        </div>
                        
                        <h2 class="font-headline-lg text-headline-lg text-primary mt-2 {{ in_array($campaign->status, ['draft', 'analyzing']) ? 'text-opacity-80' : '' }}">
                            {{ $campaign->title }}
                        </h2>
                        
                        <div class="flex items-center gap-6 mt-4">
                            @if(in_array($campaign->status, ['completed', 'pending_approval']))
                                <div class="flex flex-col">
                                    <span class="font-label-caps text-label-caps text-on-surface-variant mb-1">Drafts</span>
                                    <span class="font-title-lg text-title-lg text-primary">{{ $campaign->mediaAssets ? $campaign->mediaAssets->count() : 1 }}</span>
                                </div>
                                <div class="w-[1px] h-8 bg-outline-variant/30"></div>
                                <div class="flex flex-col">
                                    <span class="font-label-caps text-label-caps text-on-surface-variant mb-1">Status</span>
                                    <span class="font-title-lg text-title-lg text-primary text-sm mt-1">{{ str_replace('_', ' ', $campaign->status) }}</span>
                                </div>
                                <div class="w-[1px] h-8 bg-outline-variant/30 hidden sm:block"></div>
                                <div class="flex flex-col hidden sm:flex">
                                    <span class="font-label-caps text-label-caps text-on-surface-variant mb-1">Channels</span>
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center border-2 border-surface text-primary"><span class="material-symbols-outlined text-[16px]">public</span></div>
                                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center border-2 border-surface text-primary"><span class="material-symbols-outlined text-[16px]">mail</span></div>
                                    </div>
                                </div>
                            @elseif($campaign->status === 'processing')
                                <div class="flex flex-col w-full min-w-[200px] sm:min-w-[300px]">
                                    <div class="flex justify-between mb-2">
                                        <span class="font-label-caps text-label-caps text-on-surface-variant">AI Progress</span>
                                        <span class="font-label-caps text-label-caps text-primary">Generating...</span>
                                    </div>
                                    <div class="h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                                        <div class="h-full bg-secondary w-[75%] rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                            @else
                                <p class="font-body-md text-body-md text-on-surface-variant max-w-md line-clamp-2">
                                    {{ $campaign->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="z-10 shrink-0 w-full md:w-auto flex justify-end mt-4 md:mt-0">
                        <a href="{{ route('campaigns.show', $campaign->id) }}" class="w-full md:w-auto flex items-center justify-center gap-2 px-8 py-4 rounded-full {{ in_array($campaign->status, ['completed', 'pending_approval']) ? 'bg-primary text-on-primary shadow-sm hover:bg-secondary' : 'bg-transparent border border-primary/20 text-primary hover:bg-surface-container-high' }} font-body-lg text-body-lg transition-colors">
                            {{ $campaign->status === 'completed' ? 'Review Insights' : 'Monitor / Edit' }}
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</x-app-layout>
