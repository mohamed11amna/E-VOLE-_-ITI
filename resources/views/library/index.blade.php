<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-32">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="font-display-md text-display-md text-primary tracking-tight">Your Library</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">All your generated campaign images in one place.</p>
            </div>
            <a href="{{ route('campaigns.create') }}" class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-body-md text-body-md hover:bg-secondary transition-colors duration-300">
                New Campaign
            </a>
        </div>

        @if($campaigns->isEmpty())
            <div class="bg-surface-container-low rounded-3xl p-16 text-center border border-on-surface/5">
                <span class="material-symbols-outlined text-[64px] text-on-surface-variant/30 mb-4">photo_library</span>
                <h3 class="font-headline-lg text-headline-lg text-primary mb-2">No images yet</h3>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-md mx-auto">You haven't generated any final ad images yet. Start a new campaign to see them here.</p>
                <a href="{{ route('campaigns.create') }}" class="inline-flex px-6 py-2.5 rounded-full bg-secondary-container text-on-secondary-container font-body-md text-body-md hover:bg-secondary hover:text-on-secondary transition-colors duration-300">
                    Create Campaign
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($campaigns as $campaign)
                    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden border border-on-surface/5 hover:shadow-lg transition-shadow duration-300 flex flex-col group">
                        <div class="aspect-square relative bg-surface-container overflow-hidden">
                            <img src="{{ asset($campaign->final_image_url) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0">
                                <a href="{{ asset($campaign->final_image_url) }}" download class="w-10 h-10 rounded-full bg-surface-container-lowest text-primary flex items-center justify-center hover:bg-secondary hover:text-on-secondary transition-colors">
                                    <span class="material-symbols-outlined text-sm">download</span>
                                </a>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="font-title-lg text-title-lg text-primary hover:text-secondary transition-colors line-clamp-1 mb-2">{{ $campaign->title }}</a>
                                <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2">{{ $campaign->ad_caption ?? $campaign->description }}</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-on-surface/5 flex justify-between items-center text-sm text-on-surface-variant font-body-md">
                                <span>{{ $campaign->created_at->format('M j, Y') }}</span>
                                <a href="{{ route('campaigns.show', $campaign->id) }}" class="text-secondary hover:underline flex items-center gap-1">
                                    View Campaign <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $campaigns->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
