<?php

use App\Livewire\AllNews;
use App\Livewire\Article;
use App\Livewire\Author;
use App\Livewire\Category;
use App\Livewire\Home;
use App\Livewire\Location;
use App\Livewire\Site;
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

Route::get('/', Site::class);

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
Route::get('/author/{user:slug}', Author::class)->name('author');
Route::get('/article/{article:slug}', Article::class)->name('article');
Route::get('/all-news', AllNews::class)->name('all-news');

