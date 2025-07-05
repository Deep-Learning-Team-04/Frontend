<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl = 'https://7921-103-143-22-10.ngrok-free.app/';

    public function post(string $endpoint, array $data)
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($this->baseUrl . $endpoint, $data);
    }

    public function get(string $endpoint, ?string $token = null)
    {
        return Http::withToken($token)->get($this->baseUrl . $endpoint);
    }

    // Bisa tambah PUT, DELETE jika perlu nanti
}
