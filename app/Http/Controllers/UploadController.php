<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{
    /**
     * Menyimpan data lagu atau artis baru berdasarkan request.
     */
    public function store(Request $request)
    {
        // Tentukan tipe upload berdasarkan input yang ada
        $isSongUpload = $request->has('song_name');
        $isArtistUpload = !$isSongUpload && $request->has('name');

        if ($isSongUpload) {
            return $this->uploadSong($request);
        } elseif ($isArtistUpload) {
            return $this->uploadArtist($request);
        }

        // Jika tidak ada data yang cocok
        return response()->json(['status' => 'error', 'message' => 'Invalid request data provided.'], 400);
    }

    /**
     * Menangani proses upload lagu ke API Python/Flask.
     */
    private function uploadSong(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'song_name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'artist_id' => 'required|string',
            'file' => 'required|file|mimes:mp3,wav,mpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        // get token dari session
        $token = session('token');
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized: Missing session token.'], 401);
        }

        // Kirim request ke API Flask dengan otentikasi
        $response = Http::withToken($token) 
            ->attach('file', file_get_contents($request->file('file')), $request->file('file')->getClientOriginalName())
            ->post('https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/songs/upload', [
                'song_name' => $request->input('song_name'),
                'genre' => $request->input('genre'),
                'artist_id' => $request->input('artist_id'),
            ]);

        // pengecekan status dan buat respons yang konsisten
        if ($response->successful() && $response->json('status') === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => $response->json('message') ?: 'Lagu berhasil diunggah.'
            ]);
        } else {
            // Jika gagal, kirim status error
            return response()->json([
                'status' => 'error',
                'message' => $response->json('message') ?: 'Gagal mengunggah lagu ke server API.'
            ], $response->status());
        }
    }


    // Menangani proses upload artis ke API Python/Flask.

    private function uploadArtist(Request $request)
    {
        // alidasi input (tetap sama)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        // get token dari session (tetap sama)
        $token = session('token');
        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized: Missing session token.'], 401);
        }

        // Kirim request ke API Flask
        $httpRequest = Http::withToken($token)->asMultipart();

        if ($request->hasFile('image')) {
            $httpRequest->attach('image', file_get_contents($request->file('image')), $request->file('image')->getClientOriginalName());
        }

        $response = $httpRequest->post('https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/artists/upload', [
            'name' => $request->input('name')
        ]);
   
        // mengecek apakah request ke API 
        if ($response->successful()) { 
             return response()->json([
                'status' => 'success',
                'message' => $response->json('message') ?: 'Artis Berhasil Ditambahkan' // Ambil pesan dari API
            ]);
        } else {
            // Jika gagal, kirim status error
            return response()->json([
                'status' => 'error',
                'message' => $response->json('message') ?: 'Gagal menambahkan artis ke server API.'
            ], $response->status());
        }
    }
}