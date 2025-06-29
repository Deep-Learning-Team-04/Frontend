<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Kirim request ke API eksternal
            $response = $this->api->post('/auth/login', $validator->validated());
            // Cek apakah berhasil
            if ($response->successful()) {
                $data = $response->json();
                // Ambil token dan username 
                $token = $data['token'] ?? null;
                $user  = [
                    'username' => $data['username'] ?? null,
                    'email'    => $data['email'] ?? null,
                ];
                if ($token && $user['username']) {
                    // Simpan ke session
                    Session::put('token', $token);
                    Session::put('user', $user);
                    // Jika "ingat saya" dicentang
                    if ($request->has('remember')) {
                        Session::put('remember_me', true);
                    }
                    // Redirect ke home
                    return redirect()->route('user.home')->with('success', 'login Berhasil!');
                }
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['login' => 'Email atau password salah!' . $e->getMessage()])
                ->withInput();
        }
    }
    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Session::forget(['token', 'user', 'remember_me']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
