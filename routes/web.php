<?php

use App\Livewire\Article;
use App\Livewire\Category;
use App\Livewire\Location;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/category/{category:slug}', Category::class)->name('by-category');
Route::get('/location/{location:slug}', Location::class)->name('by-location');
Route::get('/{article:slug}', Article::class)->name('article');
