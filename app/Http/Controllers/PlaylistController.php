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
public function list(Request $request)
{
    $playlists = [];

    try {
        $response = $this->api->get('/playlists/list');
        dd($response);

         $playlists = $response;
    } catch (\Exception $e) {
        \Log::error('Gagal ambil playlist: ' . $e->getMessage());
    }

    return view('user.playlists', [
        'playlists' => $playlists,
        'selectedId' => $request->query('id')
    ]);
}

}
