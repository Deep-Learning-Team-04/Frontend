<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiClient; // Jika kamu menggunakan ApiClient

class CreatePlaylistController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            $response = $this->api->post('/playlists', $validated); // Kirim data ke API

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Playlist berhasil ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan playlist.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
