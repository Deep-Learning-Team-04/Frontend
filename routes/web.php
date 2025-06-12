<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// admin
Route::get('/inputartis', function () {
    return view('admin.inputartis');
})->name('admin.inputartis');

Route::get('/inputlagu', function () {
    return view('admin.inputlagu');
})->name('admin.inputlagu');


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

Route::get('/favorite', function () {
    return view('user.favorite');
})->name('user.favorite');

Route::get('/rekomendasiplaylist', function () {
    return view('user.rekomendasiplaylist');
})->name('user.rekomendasiplaylist');

Route::get('/artis', function () {
    return view('user.artis');
})->name('user.artis');

require __DIR__.'/auth.php';
