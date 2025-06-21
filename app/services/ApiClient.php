<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl = 'http://52.70.81.245:5000';

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
