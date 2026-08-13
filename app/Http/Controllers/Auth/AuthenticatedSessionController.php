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
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $response = $this->api->post(
                '/auth/login',
                $validator->validated()
            );

            if (!$response->successful()) {
                return redirect()->back()
                    ->withErrors([
                        'login' => 'Email atau password salah!'
                    ])
                    ->withInput();
            }

            $data = $response->json();

            $token = $data['token'] ?? null;

            $user = [
                'username' => $data['username'] ?? null,
                'email' => $data['email'] ?? null,
            ];

            if (!$token || !$user['username'] || !$user['email']) {
                Log::error('Login response tidak lengkap', [
                    'response' => $data,
                ]);

                return redirect()->back()
                    ->withErrors([
                        'login' => 'Data user dari API tidak lengkap.'
                    ])
                    ->withInput();
            }

            // Simpan token dan data user ke session
            Session::put('token', $token);
            Session::put('user', $user);

            // Regenerate session setelah login
            $request->session()->regenerate();

            if ($request->boolean('remember')) {
                Session::put('remember_me', true);
            }

            Log::info('LOGIN SESSION', [
                'token' => $request->session()->get('token'),
                'user' => $request->session()->get('user'),
                'session_id' => $request->session()->getId(),
            ]);

            return redirect()
                ->route('user.home')
                ->with('success', 'Login berhasil!');

        } catch (\Exception $e) {

            Log::error('Login error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->withErrors([
                    'login' => 'Terjadi kesalahan saat login.'
                ])
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
