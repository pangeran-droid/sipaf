<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAsistenController extends Controller
{
    public function index()
    {
        $title = 'Ai Asisten';

        return view('admin.ai-asisten.index', compact('title'));
    }

    public function tanya(Request $request)
    {
        $request->validate([
            'messages' => 'required|array|min:1',
            'messages.*.role' => 'required|in:user,assistant',
            'messages.*.content' => 'required|string|max:5000',
        ]);

        $apiKey = env('OPENROUTER_KEY');

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'jawaban' => 'OPENROUTER_KEY belum dikonfigurasi di file .env.'
            ], 500);
        }

        /* System Instruction */
        $systemInstruction = config('ai.system_instruction');

        $messages = [
            [
                'role' => 'system',
                'content' => $systemInstruction
            ]
        ];

        foreach ($request->messages as $message) {
            $messages[] = [
                'role' => $message['role'],
                'content' => $message['content']
            ];
        }

        try {

            $response = Http::timeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'google/gemini-2.5-flash-lite',
                    'messages' => $messages,
                    'temperature' => 0.7,
                    'max_tokens' => 2000,
                ]);

            if ($response->successful()) {

                $hasil = $response->json('choices.0.message.content');

                if (!$hasil) {

                    Log::error('OpenRouter tidak memberikan content', [
                        'response' => $response->json(),
                    ]);

                    return response()->json([
                        'status' => 'error',
                        'jawaban' => 'AI tidak memberikan jawaban. Silakan coba lagi.'
                    ], 500);
                }

                return response()->json([
                    'status' => 'success',
                    'jawaban' => $hasil
                ]);
            }

            Log::error('OpenRouter Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'status' => 'error',
                'jawaban' => 'Maaf, asisten AI sedang mengalami kendala. Silakan coba lagi.'
            ], 500);

        } catch (\Throwable $e) {

            Log::error('SIPAF AI Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'status' => 'error',
                'jawaban' => 'Gagal terhubung ke layanan AI. Silakan coba lagi.'
            ], 500);
        }
    }
}
