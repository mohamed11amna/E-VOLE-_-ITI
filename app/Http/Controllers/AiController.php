<?php

namespace App\Http\Controllers;

use App\Models\ChatbotMessage;
use App\Models\ChatbotSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiController extends Controller
{
    public function index()
    {
        $sessions = auth()->user()->chatbotSessions()->orderBy('updated_at', 'desc')->get()->map(function($session) {
            return [
                'id' => $session->id,
                'title' => $session->title ?: 'New Muse',
                'description' => Str::limit($session->messages()->orderBy('created_at', 'asc')->first()?->content ?? 'Discussing...', 40)
            ];
        })->toArray();

        // Pass empty messages by default, we rely on the frontend to either load a session or start fresh
        $messages = [];

        return view('chatbot.index', compact('sessions', 'messages'));
    }

    public function loadSession($id)
    {
        $session = auth()->user()->chatbotSessions()->findOrFail($id);
        
        $messages = $session->messages()->orderBy('id', 'asc')->get(['role', 'content'])->map(function ($msg) {
            return [
                'role' => $msg->role,
                'content' => $msg->content
            ];
        })->toArray();

        return response()->json(['messages' => $messages]);
    }

    public function message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|exists:chatbot_sessions,id'
        ]);

        $userMessage = $request->input('message');
        $user = auth()->user();
        $sessionId = $request->input('session_id');

        if (!$sessionId) {
            $session = $user->chatbotSessions()->create([
                'title' => Str::limit($userMessage, 30)
            ]);
            $sessionId = $session->id;
            
            // Generate welcome message for new session
            $welcomeContent = 'Hello! I am your È VOLE Marketing Assistant. I can help you navigate the platform, suggest ad strategies, or explain marketing concepts. How can I assist you today?';
            $session->messages()->create([
                'user_id' => $user->id,
                'role' => 'assistant',
                'content' => $welcomeContent
            ]);
        } else {
            $session = $user->chatbotSessions()->findOrFail($sessionId);
            $session->touch(); // Update updated_at
        }
        
        // Save user message
        $session->messages()->create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userMessage
        ]);

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'AI Service is currently unavailable.'], 500);
        }

        // Fetch recent history for context (last 10 messages)
        $history = $session->messages()->orderBy('id', 'desc')->take(10)->get()->reverse();
        
        $contents = [];
        $systemPrompt = "You are the È VOLE Marketing Assistant. Help users navigate the È VOLE platform and answer general marketing, SEO, and ad strategy questions. Be concise, professional, and helpful. Format your responses in plain text or simple markdown.";
        
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $systemPrompt]]
        ];
        $contents[] = [
            'role' => 'model',
            'parts' => [['text' => 'Understood.']]
        ];

        foreach ($history as $msg) {
            $contents[] = [
                'role' => $msg->role === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $msg->content]]
            ];
        }

        try {
            $response = Http::withoutVerifying()->timeout(60)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}", [
                'contents' => $contents
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $reply = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'I could not process that request.';
                $reply = trim($reply);
                
                // Save AI response
                $session->messages()->create([
                    'user_id' => $user->id,
                    'role' => 'assistant',
                    'content' => $reply
                ]);

                return response()->json([
                    'reply' => $reply,
                    'session_id' => $session->id,
                    'title' => $session->title,
                    'description' => Str::limit($userMessage, 40)
                ]);
            }

            Log::error("Gemini API Error (Chatbot): " . $response->body());
            return response()->json(['error' => 'Failed to connect to AI.'], 500);

        } catch (\Exception $e) {
            Log::error("Chatbot exception: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
}


