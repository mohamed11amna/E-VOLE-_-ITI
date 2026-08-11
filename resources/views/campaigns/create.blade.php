<x-app-layout>
    <div class="pt-10 pb-section-gap min-h-screen flex flex-col md:flex-row gap-section-gap">
        <!-- Left Column: The Creative Atelier (Input Form) -->
        <section class="flex-1 max-w-2xl mx-auto md:mx-0">
            <header class="mb-16">
                <h1 class="font-display-lg text-display-lg text-primary mb-4">The Creative Atelier</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Sculpt your campaign's visual identity. Upload primary assets and define the core narrative.</p>
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('campaigns.index') }}" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Back to Dashboard
                    </a>
                </div>
            </header>

            @if ($errors->any())
                <div class="mb-8 rounded-xl border border-error/20 bg-error-container/50 p-6 text-sm text-on-error-container">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data" class="space-y-16">
                @csrf
                
                <!-- 1. Media Upload -->
                <div class="space-y-6">
                    <label class="block font-headline-lg text-headline-lg text-primary">01. Visual Assets</label>
                    <label for="product_images" class="block relative group cursor-pointer">
                        <div class="absolute inset-0 bg-secondary/5 rounded-xl transition-all duration-300 group-hover:bg-secondary/10"></div>
                        <div class="relative border-2 border-dashed border-secondary/30 rounded-xl p-12 text-center transition-all duration-300 group-hover:border-secondary flex flex-col items-center justify-center gap-4 bg-surface">
                            <div class="w-16 h-16 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined" style="font-size: 32px;">upload_file</span>
                            </div>
                            <h3 class="font-title-lg text-title-lg text-primary">Upload Primary Media</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant">Drag and drop high-resolution imagery. Plain backgrounds work best.</p>
                            <span class="mt-4 px-6 py-3 rounded-full border border-primary text-primary font-body-md hover:bg-surface-container transition-colors inline-block">Browse Files</span>
                        </div>
                        <input id="product_images" name="product_images[]" type="file" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                    </label>
                </div>

                <!-- 2. Product Name and Details -->
                <div class="space-y-10 relative">
                    <!-- Subtle connecting line -->
                    <div class="hidden md:block absolute left-[-40px] top-10 bottom-10 w-px bg-outline-variant/30"></div>
                    
                    <div class="space-y-6">
                        <label class="block font-headline-lg text-headline-lg text-primary" for="title">02. Campaign Nomenclature</label>
                        <input id="title" name="title" value="{{ old('title') }}" required class="w-full bg-transparent border-0 border-b border-outline-variant/50 focus:border-secondary focus:ring-0 px-0 py-4 font-body-lg text-body-lg text-primary placeholder:text-on-surface-variant/50 transition-colors" placeholder="E.g., Autumn/Winter Collection '24" type="text"/>
                    </div>
                    
                    <div class="space-y-6">
                        <label class="block font-headline-lg text-headline-lg text-primary" for="description">03. Narrative Details</label>
                        <textarea id="description" name="description" required class="w-full bg-surface-container-high/30 rounded-lg border-0 focus:ring-0 focus:bg-surface-container-high/50 p-6 font-body-lg text-body-lg text-primary placeholder:text-on-surface-variant/50 transition-colors resize-none" placeholder="Describe the mood, key selling points, and target aesthetic..." rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="space-y-6">
                        <label class="block font-headline-lg text-headline-lg text-primary" for="user_scenario">04. Scene Direction <span class="opacity-50 text-xl">(Optional)</span></label>
                        <textarea id="user_scenario" name="user_scenario" class="w-full bg-surface-container-high/30 rounded-lg border-0 focus:ring-0 focus:bg-surface-container-high/50 p-6 font-body-lg text-body-lg text-primary placeholder:text-on-surface-variant/50 transition-colors resize-none" placeholder="Nocturnal studio, wet stone, amber rim light..." rows="3">{{ old('user_scenario') }}</textarea>
                    </div>
                </div>

                <!-- 3. AI Assist Toggle -->
                <div class="space-y-6">
                    <label class="block font-headline-lg text-headline-lg text-primary">05. Intelligence</label>
                    <div class="flex items-center justify-between p-8 rounded-xl bg-surface-container-low border border-outline-variant/20 hover:border-secondary/30 transition-colors">
                        <div>
                            <h4 class="font-title-lg text-title-lg text-primary mb-1">AI Generative Assist</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant">Allow È VOLE to auto-generate variations and optimize copy for luxury segments.</p>
                        </div>
                        <div class="relative inline-block w-12 mr-2 align-middle select-none">
                            <input checked class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer opacity-0" id="ai-toggle" name="toggle" type="checkbox"/>
                            <label class="toggle-label block overflow-hidden h-6 rounded-full bg-surface-variant cursor-pointer" for="ai-toggle"></label>
                            <div class="toggle-dot absolute block w-5 h-5 rounded-full bg-white shadow inset-y-0 left-0 pointer-events-none mt-[2px] ml-[2px]"></div>
                        </div>
                    </div>
                    <style>
                        .toggle-checkbox:checked { right: 0; border-color: theme('colors.secondary'); }
                        .toggle-checkbox:checked + .toggle-label { background-color: theme('colors.secondary'); }
                        .toggle-checkbox { right: 0; z-index: 1; border-color: theme('colors.outline-variant'); transition: all 0.3s; }
                        .toggle-label { width: 3rem; height: 1.5rem; background-color: theme('colors.surface-variant'); border-radius: 9999px; transition: all 0.3s; }
                        .toggle-dot { top: 0.25rem; left: 0.25rem; width: 1rem; height: 1rem; background-color: white; border-radius: 50%; transition: all 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
                        .toggle-checkbox:checked ~ .toggle-dot { transform: translateX(1.5rem); }
                    </style>
                </div>

                <div class="pt-8 flex justify-end pb-20">
                    <button type="submit" class="bg-primary text-on-primary font-body-md px-10 py-4 rounded-full hover:bg-secondary transition-colors duration-300 shadow-sm flex items-center gap-2">
                        <span>Generate Drafts</span>
                        <span class="material-symbols-outlined">auto_awesome</span>
                    </button>
                </div>
            </form>
        </section>

        <!-- Right Column: Live Preview Pane (Floating Canvas) -->
        <section class="hidden md:block flex-1 relative min-h-[800px]">
            <div class="sticky top-32 glass-panel rounded-xl w-full h-[819px] overflow-hidden shadow-[0_20px_40px_-10px_rgba(0,0,0,0.05)] flex flex-col p-8 bg-surface/70 backdrop-blur-xl border border-inverse-surface/5">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">Live Preview Canvas</h2>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-full flex items-center justify-center bg-surface-variant text-secondary transition-colors"><span class="material-symbols-outlined" style="font-size: 18px;">smartphone</span></button>
                        <button class="w-8 h-8 rounded-full flex items-center justify-center bg-surface-container hover:bg-surface-variant transition-colors"><span class="material-symbols-outlined" style="font-size: 18px;">desktop_mac</span></button>
                    </div>
                </div>
                
                <!-- Preview Area -->
                <div class="flex-1 bg-surface-container-lowest rounded-lg border border-outline-variant/10 overflow-hidden relative flex items-center justify-center">
                    <div class="absolute z-10 flex flex-col items-center opacity-40">
                        <span class="material-symbols-outlined text-primary mb-4" style="font-size: 48px; font-variation-settings: 'wght' 200;">style</span>
                        <p class="font-body-md text-body-md text-primary max-w-[200px] text-center">Awaiting assets to render preview...</p>
                        <p class="text-xs text-on-surface-variant mt-2 text-center max-w-[250px]">Fill in the details and hit Generate Drafts. We'll render the scene prompt, four creative variants, and platform-ready copy.</p>
                    </div>
                </div>

                <!-- Preview Controls -->
                <div class="mt-6 flex justify-between items-center px-4 border-t border-outline-variant/20 pt-6">
                    <span class="font-body-md text-body-md text-on-surface-variant">Step 1 of 3</span>
                    <span class="flex items-center gap-2 text-primary font-body-md opacity-70">
                        <span class="material-symbols-outlined" style="font-size: 20px;">schedule</span>
                        Drafts typically render in ~40s
                    </span>
                </div>
            </div>

            <!-- Decorative overlapping elements -->
            <div class="absolute -right-8 top-1/4 w-32 h-64 bg-secondary-container/10 rounded-full blur-3xl -z-10"></div>
            <div class="absolute -bottom-10 left-10 w-48 h-48 bg-primary-fixed-dim/20 rounded-full blur-3xl -z-10"></div>
        </section>
    </div>
</x-app-layout>

