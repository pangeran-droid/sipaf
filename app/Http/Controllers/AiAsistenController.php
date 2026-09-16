<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiAsistenController extends Controller
{
    public function index()
    {
        return view('admin.ai-asisten.index');
    }

    public function tanya(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        $apiKey = env('GEMINI_API_KEY');
        $prompt = $request->pesan;

        // System prompt
        $systemInstruction = config('ai.system_instruction');

        // Request to API Gemini
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://googleapis.com{$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemInstruction . "\n\nPertanyaan Admin: " . $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $hasil = $response->json('candidates.0.content.parts.0.text');
            return response()->json(['status' => 'success', 'jawaban' => $hasil]);
        }

        return response()->json(['status' => 'error', 'jawaban' => 'Maaf, asisten AI sedang sibuk. Coba lagi nanti.'], 500);
    }
}
