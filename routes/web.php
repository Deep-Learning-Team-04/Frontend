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

require __DIR__.'/auth.php';
