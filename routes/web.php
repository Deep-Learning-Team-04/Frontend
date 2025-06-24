<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::post('/logout', function () {
    return redirect('/'); 
})->name('logout');

Route::get('/regis', function () {
    return view('regis');
})->name('regis');

Route::get('/inputartis', function () {
    return view('user.inputartis');
})->name('user.inputartis');

Route::get('/inputlagu', function () {
    return view('user.inputlagu');
})->name('user.inputlagu');

//user
Route::get('/home', function () {
    return view('user.home');
})->name('user.home');

Route::get('/profile', function () {
    return view('user.profile');
})->name('user.profile');

Route::get('/playlist', function () {
    return view('user.playlist');
})->name('user.playlist');

Route::get('/rekomendasiplaylist', function () {
    return view('user.rekomendasiplaylist');
})->name('user.rekomendasiplaylist');

Route::get('/playlist', function () {
    return view('user.playlist');
})->name('user.playlist');

Route::get('/favorite', function () {
    return view('user.favorite');
})->name('user.favorite');

Route::get('/artis', function () {
    return view('user.artis');
})->name('user.artis');
