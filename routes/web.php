<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreatePlaylistController;
use App\Http\Controllers\ArtisController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RekomendasiLaguController;

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

Route::get('/profile', function () {
    return view('user.profile');
})->name('user.profile');

Route::get('/playlist', function () {
    return view('user.playlist');
})->name('user.playlist');

Route::get('/rekomendasiplaylist', function () {
    return view('user.rekomendasiplaylist');
})->name('user.rekomendasiplaylist');

// Route::get('/rekomendasiplaylist', [RekomendasiLaguController::class, 'getRecommendations'])
//     ->name('user.rekomendasiplaylist');

Route::get('/playlist', function () {
    return view('user.playlist');
})->name('user.playlist');

// Route::get('/playlists/list', [PlaylistController::class, 'list'])->name('user.sidebar');
// Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
Route::post('/playlists/create', [PlaylistController::class, 'store'])->name('playlist.store');
// routes/web.php

Route::get('/playlists', [PlaylistController::class, 'index']);
Route::post('/playlists/{playlistId}/add-song', [PlaylistController::class, 'addSongToPlaylist']);
// Route::post('/playlists/create', [CreatePlaylistController::class, 'store'])->name('playlist.store');


Route::get('/favorite', function () {
    return view('user.favorite');
})->name('user.favorite');

Route::get('/home', [HomeController::class, 'index'])->name('user.home');
Route::post('/save-mood', [HomeController::class, 'saveMood'])->name('save.mood');
Route::post('/songs/play', [HomeController::class, 'play']);

Route::get('/artists/{id}', [ArtisController::class, 'show'])->name('artis');
Route::post('/artists/{artist}/toggle-favorite', [ArtisController::class, 'toggleFavorite'])->name('artists.toggle-favorite');

Route::get('/rekomendasiplaylist', [RekomendasiLaguController::class, 'getRecommendations'])
    ->name('user.rekomendasiplaylist');

