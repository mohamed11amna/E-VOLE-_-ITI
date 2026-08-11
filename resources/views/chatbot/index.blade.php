<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>È VOLE - Chat Atelier</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,wght@6..96,400..900&amp;family=Inter:wght@400..700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/theme.css">
    <script src="/js/theme.js"></script>
    <script src="/js/tailwind-config.js"></script>
<style>
        body {
            background-image: radial-gradient(circle at top right, rgba(254, 173, 158, 0.1) 0%, transparent 40%),
                              radial-gradient(circle at bottom left, rgba(140, 77, 66, 0.05) 0%, transparent 40%);
            background-color: theme('colors.surface-bright');
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .soft-shadow {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.03);
        }
        
        /* Custom Scrollbar for elegant feel */
        ::-webkit-scrollbar {
            width: 4px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: theme('colors.surface-variant');
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: theme('colors.outline');
        }
      </style>
</head>
<body class="text-on-surface h-screen overflow-hidden flex font-body-lg antialiased">
<!-- Top Navigation (Shared Component implementation) -->
<nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] rounded-full bg-surface/80 dark:bg-inverse-surface/80 backdrop-blur-xl border border-primary/5 dark:border-on-primary/5 shadow-sm z-50">
<div class="flex justify-between items-center px-8 h-16 w-full max-w-7xl mx-auto">
<div class="flex items-center gap-4">
<span class="font-headline-lg text-headline-lg tracking-tighter text-primary dark:text-on-primary">È VOLE</span>
</div>
<div class="hidden md:flex gap-8">
<a class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-container transition-colors duration-300 font-title-lg text-title-lg" href="{{ route('campaigns.index') }}">Dashboard</a>
<a class="text-on-surface-variant dark:text-surface-variant hover:text-secondary dark:hover:text-secondary-container transition-colors duration-300 font-title-lg text-title-lg" href="{{ route('campaigns.create') }}">Campaigns</a>
</div>
<div class="flex items-center gap-4">
<a href="{{ route('campaigns.create') }}" class="bg-primary text-on-primary px-6 py-2 rounded-full hover:bg-secondary transition-colors duration-300 font-label-caps text-label-caps active:scale-95">Create Ad</a>
<a href="{{ route('campaigns.index') }}" class="text-primary hover:text-secondary transition-colors duration-300 active:scale-95">
<span class="material-symbols-outlined">close</span>
</a>
<img class="w-8 h-8 rounded-full object-cover border border-primary/10" data-alt="A sophisticated minimalist avatar of a high-fashion user profile, utilizing soft lighting and ethereal textures, embodying a serene and premium light-mode aesthetic in soft charcoal and white." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBe_-xg02ixGTeCCp000ePco9z4qo4fCuXCquFTucss2DPkKZRRhxOQZ4T0iXW5gxIa67ky7f9nklFtXPXGiOdVEy08U3sZ2WAa_11irEUSltt-Vl5Bt0DnGD-MwjwU83h8DpWx316QXif57muBhszB1Ef4niru8y_CDjW1uIpHK8P6qaE6ZNlbnm1vUlKINwEMoZooKeBw8Epxl9SxiIUrQHlPV9A-4_BtfKuLIv7XChIpCckfHwhGfw"/>
</div>
</div>
</nav>
<!-- Sidebar Layout -->
<div x-data="chatbot({{ json_encode($messages) }}, {{ json_encode($sessions) }})" class="flex w-full h-full pt-28 pb-8 px-8 gap-8 max-w-[1600px] mx-auto">
<!-- Left Sidebar: History -->
<aside x-show="showHistory" x-transition class="w-80 flex-shrink-0 flex flex-col gap-6" style="display: none;">
<button @click="startNewSession" class="w-full glass-panel rounded-xl p-4 flex items-center justify-center gap-2 text-primary hover:bg-secondary/5 transition-colors duration-300 group soft-shadow">
<span class="material-symbols-outlined text-secondary group-hover:rotate-90 transition-transform duration-500">add</span>
<span class="font-title-lg text-title-lg">New Muse</span>
</button>
<div class="flex-1 overflow-y-auto pr-2 space-y-4 custom-scrollbar">
<div class="font-label-caps text-label-caps text-on-surface-variant mb-4 pl-2">Recent Collaborations</div>
<!-- Dynamic History Items -->
<template x-for="session in sessions" :key="session.id">
    <div @click="loadSession(session.id)" :class="activeSessionId === session.id ? 'p-4 rounded-xl bg-surface-container cursor-pointer transition-colors duration-300 border border-primary/5 relative overflow-hidden' : 'p-4 rounded-xl cursor-pointer hover:bg-surface-variant/30 transition-colors duration-300 border border-transparent hover:border-primary/5'">
        <template x-if="activeSessionId === session.id">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary"></div>
        </template>
        <div class="font-title-lg text-title-lg mb-1 truncate" :class="activeSessionId === session.id ? 'pl-2 text-secondary' : ''" x-text="session.title"></div>
        <div class="font-body-md text-body-md text-on-surface-variant truncate" :class="activeSessionId === session.id ? 'pl-2' : ''" x-text="session.description"></div>
    </div>
</template>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="flex-1 glass-panel rounded-3xl relative overflow-hidden flex flex-col soft-shadow border border-primary/5">
<div class="absolute inset-0 bg-surface-lowest/50"></div>
<div id="chat-container" class="relative z-10 flex-1 overflow-y-auto p-8 custom-scrollbar">

<!-- Header Controls -->
<div class="flex justify-between items-center mb-8 sticky top-0 z-20">
    <button @click="showHistory = !showHistory" class="p-2 rounded-full hover:bg-surface-variant/50 transition-colors text-primary flex items-center justify-center">
        <span class="material-symbols-outlined" x-text="showHistory ? 'menu_open' : 'menu'">menu</span>
    </button>
</div>

<div class="flex flex-col gap-8 pb-32">
<!-- Dynamic Messages -->
<template x-for="(msg, index) in messages" :key="index">
    <div :class="msg.role === 'user' ? 'flex gap-6 max-w-3xl self-end flex-row-reverse' : 'flex gap-6 max-w-4xl self-start'">
        <!-- Avatar -->
        <template x-if="msg.role === 'user'">
            <img class="w-12 h-12 rounded-full object-cover flex-shrink-0 soft-shadow" src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}"/>
        </template>
        <template x-if="msg.role !== 'user'">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center flex-shrink-0 soft-shadow">
                <span class="material-symbols-outlined text-on-secondary-container">auto_awesome</span>
            </div>
        </template>
        
        <!-- Bubble -->
        <div :class="msg.role === 'user' ? 'bg-primary text-on-primary p-6 rounded-xl rounded-tr-none soft-shadow' : 'glass-panel p-8 rounded-xl rounded-tl-none soft-shadow w-full'">
            <p class="font-body-lg text-body-lg leading-relaxed" :class="msg.role === 'user' ? '' : 'text-on-surface'" x-text="msg.content"></p>
        </div>
    </div>
</template>

<!-- Typing Indicator -->
<div x-show="isTyping" class="flex gap-6 max-w-4xl self-start opacity-50" style="display: none;">
    <div class="w-12 h-12 rounded-full bg-secondary-container/50 flex items-center justify-center flex-shrink-0">
        <span class="material-symbols-outlined text-on-secondary-container text-sm animate-pulse">more_horiz</span>
    </div>
</div>
</div>
</div>
<!-- Input Area -->
<div class="absolute bottom-0 left-0 right-0 p-8 pt-12 bg-gradient-to-t from-surface-bright via-surface-bright/90 to-transparent z-20">
<div class="max-w-3xl mx-auto relative">
<div class="glass-panel rounded-xl p-2 flex items-end gap-2 soft-shadow border border-primary/10 bg-surface/80">
<textarea x-model="inputText" @keydown.enter.prevent="sendMessage" class="w-full bg-transparent border-none focus:ring-0 resize-none font-body-lg text-body-lg p-4 placeholder:text-outline max-h-32" placeholder="Ask about marketing or È VOLE..." rows="1"></textarea>
<button @click="sendMessage" :disabled="isTyping || inputText.trim() === ''" class="bg-secondary text-on-secondary w-12 h-12 rounded-full flex items-center justify-center hover:bg-secondary-container hover:text-on-secondary-container transition-colors duration-300 flex-shrink-0 m-2 disabled:opacity-50">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</div>
</main>
</div>
<script>
    function chatbot(initialMessages = [], initialSessions = []) {
        return {
            messages: initialMessages,
            sessions: initialSessions,
            activeSessionId: null,
            inputText: '',
            isTyping: false,
            showHistory: false,
            
            init() {
                // Load first session if we have any, else leave it empty
                if (this.sessions.length > 0) {
                    this.loadSession(this.sessions[0].id);
                } else {
                    this.startNewSession();
                }
            },

            startNewSession() {
                this.activeSessionId = null;
                this.messages = [
                    { role: 'assistant', content: 'Hello! I am your È VOLE Marketing Assistant. I can help you navigate the platform, suggest ad strategies, or explain marketing concepts. How can I assist you today?' }
                ];
            },

            async loadSession(id) {
                if(this.isTyping) return;
                this.activeSessionId = id;
                this.messages = [];
                
                try {
                    const response = await fetch(`/chatbot/session/${id}`);
                    const data = await response.json();
                    if(response.ok) {
                        this.messages = data.messages;
                    }
                } catch(e) {
                    console.error('Failed to load session');
                }
                this.scrollToBottom();
            },
            
            async sendMessage() {
                if (this.inputText.trim() === '' || this.isTyping) return;
                
                const userMsg = this.inputText.trim();
                this.messages.push({ role: 'user', content: userMsg });
                this.inputText = '';
                this.isTyping = true;
                
                this.scrollToBottom();
                
                try {
                    const response = await fetch('{{ route("chatbot.message") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ 
                            message: userMsg,
                            session_id: this.activeSessionId
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        // If it was a new session, update active ID and sidebar
                        if (!this.activeSessionId && data.session_id) {
                            this.activeSessionId = data.session_id;
                            this.sessions.unshift({
                                id: data.session_id,
                                title: data.title,
                                description: data.description
                            });
                        }
                        this.messages.push({ role: 'assistant', content: data.reply });
                    } else {
                        this.messages.push({ role: 'assistant', content: 'Sorry, I encountered an error: ' + (data.error || 'Unknown error') });
                    }
                } catch (e) {
                    this.messages.push({ role: 'assistant', content: 'Network error. Please try again.' });
                } finally {
                    this.isTyping = false;
                    this.scrollToBottom();
                }
            },
            
            scrollToBottom() {
                setTimeout(() => {
                    const container = document.getElementById('chat-container');
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                }, 100);
            }
        }
    }

    // Auto-resize textarea
    const textarea = document.querySelector('textarea');
    if(textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
            if(this.value === '') this.style.height = 'auto';
        });
    }
</script>
</body></html>
