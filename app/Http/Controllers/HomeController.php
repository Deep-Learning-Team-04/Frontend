<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function getRecommendations()
    {
        $email = session('user')['username'] ?? 'default@email.com';

        try {
            $response = $this->api->get("users/{$email}/recommendations");

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['error' => 'Failed to get recommendations'], 400);
        } catch (\Exception $e) {
            Log::error('Error getting recommendations: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function index()
    {
        $songs = [];
        $artists = [];

        // Ambil data artis
        try {
            $artistsResponse = $this->api->get('artists');
            if ($artistsResponse->successful()) {
                $artists = $artistsResponse->json();
            } else {
                Log::error('Gagal mengambil data artis. Status: ' . $artistsResponse->status());
            }
        } catch (\Exception $e) {
            Log::error('Error saat mengambil artis: ' . $e->getMessage());
        }


        // Ambil data lagu
        try {
            $songsResponse = $this->api->get('songs/list');
            if ($songsResponse->successful()) {
                $songs = $songsResponse->json();
            } else {
                Log::error('Gagal mengambil data lagu. Status: ' . $songsResponse->status());
            }
        } catch (\Exception $e) {
            Log::error('Error saat mengambil lagu: ' . $e->getMessage());
        }

        return view('user.home', [
            'songs' => $songs,
            'artists' => $artists,
        ]);
    }

    public function saveMood(Request $request)
    {
        $request->validate([
            'mood' => 'required|in:Happy,Relax,Sad,Tense'
        ]);

        $mood = $request->mood;

        $username = $request->session()->get('user.username');
        $email = $request->session()->get('user.email');


        Log::info('DEBUG SAVE MOOD', [
            'email' => $email,
            'mood' => $mood,
            'session_user' => session('user')
        ]);

        if (!$email) {
            return response()->json([
                'success' => false,
                'message' => 'User belum login atau email tidak ditemukan.'
            ], 401);
        }

        try {
            $response = $this->api->post("users/{$email}/mood", [
                'mood' => $mood
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => $response->json()['message']
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan mood'
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('Error saving mood: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }

    public function play(Request $request)
    {
        $songId = $request->input('song_id');

        // ambil user dari session
        $user = session('user');
        $userId = $user['email'] ?? null;

        // kirim ke Flask
        $response = $this->api->post('/songs/play', [
            'user_id' => $userId,
            'song_id' => $songId,
        ]);

        return response()->json($response->json(), $response->status());
    }
}
