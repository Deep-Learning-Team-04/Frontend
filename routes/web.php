<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register-success', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/logout', function () {
    return redirect('/'); // atau ke login page
})->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// admin

Route::get('/admin', function () {
    return view('admin.admindashboard');
})->name('admin.admindashboard');

Route::get('/inputartis', function () {
    return view('admin.inputartis');
})->name('admin.inputartis');

Route::get('/inputlagu', function () {
    return view('admin.inputlagu');
})->name('admin.inputlagu');


<<<<<<< HEAD
=======
// admin
Route::get('/inputartis', function () {
    return view('admin.inputartis');
})->name('admin.inputartis');

Route::get('/inputlagu', function () {
    return view('admin.inputlagu');
})->name('admin.inputlagu');


>>>>>>> 42f124953f68747f285d1fc2c93f70db54c8000c
//user
Route::get('/home', function () {
    return view('user.home');
})->name('user.home');
<<<<<<< HEAD
=======

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
>>>>>>> 42f124953f68747f285d1fc2c93f70db54c8000c

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
