<x-admin-layout>
    <!-- Header Section -->
    <header class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-primary/5 pb-8">
        <div>
            <h1 class="font-display-md text-display-md text-primary mb-2">Platform Overview</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Monitor system health, user activity, and AI generation pipelines across the È VOLE network.</p>
        </div>
        <div class="flex gap-4">
            <button class="flex items-center gap-2 border border-primary/20 px-6 py-3 rounded-full font-label-caps text-label-caps text-primary hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined">download</span>
                Export Report
            </button>
        </div>
    </header>

    <!-- Bento Grid: KPI Cards -->
    <section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-surface-container-lowest rounded-xl p-8 diffused-shadow flex flex-col justify-between h-48 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <span class="font-label-caps text-label-caps text-on-surface-variant">Active Users</span>
                <span class="material-symbols-outlined text-secondary">group</span>
            </div>
            <div>
                <div class="font-headline-lg text-[40px] text-primary mb-1">{{ number_format($activeUsers) }}</div>
                <div class="font-body-md text-body-md text-secondary flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">trending_up</span> +14.2% this week
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-surface-container-lowest rounded-xl p-8 diffused-shadow flex flex-col justify-between h-48 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <span class="font-label-caps text-label-caps text-on-surface-variant">Ads Generated</span>
                <span class="material-symbols-outlined text-secondary">image</span>
            </div>
            <div>
                <div class="font-headline-lg text-[40px] text-primary mb-1">{{ number_format($adsGenerated) }}</div>
                <div class="font-body-md text-body-md text-secondary flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">trending_up</span> +8.4% this week
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-surface-container-lowest rounded-xl p-8 diffused-shadow flex flex-col justify-between h-48 hover:-translate-y-1 transition-transform duration-300 lg:col-span-2">
            <div class="flex justify-between items-start mb-4">
                <span class="font-label-caps text-label-caps text-on-surface-variant">GPU Resource Usage</span>
                <span class="material-symbols-outlined text-secondary">memory</span>
            </div>
            <div class="flex-1 flex flex-col justify-end">
                <div class="flex justify-between font-body-md text-body-md text-primary mb-2">
                    <span>Cluster A (EU-West)</span>
                    <span>78%</span>
                </div>
                <div class="w-full h-2 bg-surface-variant rounded-full overflow-hidden mb-4">
                    <div class="h-full bg-secondary w-[78%] rounded-full"></div>
                </div>
                
                <div class="flex justify-between font-body-md text-body-md text-primary mb-2">
                    <span>Cluster B (US-East)</span>
                    <span>42%</span>
                </div>
                <div class="w-full h-2 bg-surface-variant rounded-full overflow-hidden">
                    <div class="h-full bg-secondary w-[42%] rounded-full"></div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>

