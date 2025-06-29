<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiClient;
use Illuminate\Support\Facades\Log;


class RekomendasiLaguController extends Controller
{
    protected ApiClient $api;
    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    // public function getRecommendations()
    // {
    //     $email = session('user')['username'] ?? null;

    //     if (!$email) {
    //         return redirect()->back()->with('error', 'User not authenticated');
    //     }

    //     try {
    //         $response = $this->api->get("users/{$email}/recommendations");

    //         // dd($response->json());
    //         if ($response->successful()) {
    //             $data = $response->json();
    //             $recommendedSongs = $data['recommended_songs'] ?? [];

    //             return view('user.playlit', [ // ganti dengan nama view kamu
    //                 'recommended_songs' => $recommendedSongs
    //             ]);
    //         }

    //         return redirect()->back()->with('error', 'Failed to fetch recommendations');
    //     } catch (\Exception $e) {
    //         Log::error('Recommendation API Error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Service unavailable');
    //     }
    // }
    public function getRecommendations()
    {
        $email = session('user')['username'] ?? null;

        if (!$email) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        try {
            $response = $this->api->get("users/{$email}/recommendations");

            if ($response->successful()) {
                $data = $response->json();
                return view('user.rekomendasiplaylist', [
                    'recommended_songs' => $data['recommended_songs'] ?? [],
                    'criteria' => $data['criteria'] ?? []
                ]);
            }

            return redirect()->back()->with('error', 'Failed to fetch recommendations');
        } catch (\Exception $e) {
            Log::error('Recommendation API Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Service unavailable');
        }
    }
}
