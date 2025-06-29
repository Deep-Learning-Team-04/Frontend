<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlaylistController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $response = $this->api->post('/playlists/create', [
                'name' => $request->input('name'),
                'description' => $request->input('description', ''),
            ]);

            // Debugging - log response
            Log::debug('API Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return redirect()->back()
                    ->with('success', 'Playlist berhasil dibuat!');
            }

            // Handle specific error responses
            $errorMessage = 'Gagal membuat playlist';
            if ($response->status() === 422) {
                $errorData = json_decode($response->body(), true);
                $errorMessage = $errorData['message'] ?? $errorMessage;
            }

            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage);

        } catch (\Exception $e) {
            Log::error('Error creating playlist: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }
    // App\Http\Controllers\PlaylistController.php

    public function index()
    {
        try {
            $response = $this->api->get('/playlists/list');

            if ($response->successful()) {
                $playlists = json_decode($response->body(), true);
                return response()->json($playlists);
            }

            return response()->json([], 500);

        } catch (\Exception $e) {
            Log::error('Error fetching playlists: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    // App\Http\Controllers\PlaylistController.php

    public function addSongToPlaylist(Request $request, $playlistId)
    {
        $request->validate([
            'song_id' => 'required|string'
        ]);

        try {
            $response = $this->api->post("/playlists/{$playlistId}/add_song", [
                'song_id' => $request->input('song_id')
            ]);

            if ($response->successful()) {
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal menambahkan lagu ke playlist'], 500);

        } catch (\Exception $e) {
            Log::error('Error adding song to playlist: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem'], 500);
        }
    }
}
