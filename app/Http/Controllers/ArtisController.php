<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiClient;
use Illuminate\Support\Facades\Log;

class ArtisController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function show($id)
    {
        $artist = null;
        $isFavorite = false;
        $favoriteArtists = [];
        $userEmail = session('user')['username'] ?? null;

        try {
            $artistResponse = $this->api->get('artists/' . $id);

            if ($artistResponse->successful()) {
                $artist = $artistResponse->json();
                // dd('Data Artis:', $artist);
                if ($userEmail) {
                    $favoriteCheckResponse = $this->api->get("users/{$userEmail}/favorite-artists");
                    // dd($favoriteCheckResponse->status(), $favoriteCheckResponse->body());

                    if ($favoriteCheckResponse->successful()) {
                        $favoriteArtists = $favoriteCheckResponse->json()['favorite_artists'] ?? [];
                        // dd('Data Favorite:', $favoriteCheckResponse->json());
                        // dd($isFavorite);
                    }
                }
            } else {
                Log::error('Gagal mengambil data artis dengan ID: ' . $id . '. Status: ' . $artistResponse->status());
            }
        } catch (\Exception $e) {
            Log::error('Error saat mengambil detail artis: ' . $e->getMessage());
        }

        return view('user.artis', [
            'artist' => $artist,
            'isFavorite' => $isFavorite,
            'artistId' => $id,
            'favoriteArtists' => $favoriteArtists
        ]);
    }
    public function toggleFavorite(Request $request, $artistId)
    {
        $userEmail = session('user')['username'] ?? null;

        if (!$userEmail) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        try {
            $response = $this->api->post("users/{$userEmail}/favorite-artist", [
                'artist_id' => $artistId
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => $response->json()['message'] ?? 'Favorite status updated',
                    'is_favorite' => $response->json()['is_favorite'] ?? false
                ]);
            }

            return response()->json([
                'error' => 'Failed to update favorite status',
                'status' => $response->status()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

}
