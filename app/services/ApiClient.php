<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl = 'https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/';

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
