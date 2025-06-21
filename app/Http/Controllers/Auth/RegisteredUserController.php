<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    /**
     * Show the registration page
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the registration process using external API
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        try {
            $response = $this->api->post('/auth/register', $data);
            
            if ($response->successful()) {
                $data = $response->json();

                return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
            }
        } catch (\Exception $e) {
            \Log::error('Register error: ' . $e->getMessage());
            return back()->withErrors(['register' => 'Silahkan Coba Lagi' . $e->getMessage()])->withInput();
        }
    }
}
