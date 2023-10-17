<?php

use App\Http\Controllers\SiteController;
use App\Livewire\AllNews;
use App\Livewire\Article;
use App\Livewire\Author;
use App\Livewire\Category;
use App\Livewire\Home;
use App\Livewire\Location;
use App\Livewire\Search;
use App\Livewire\Site;
use App\Livewire\Site\About;
use App\Livewire\Site\PrivacyPolicy;
use App\Livewire\Site\TermsConditions;
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

// Footer
Route::get('/about-us', About::class)->name('about-us');
Route::get('/terms-and-conditions', TermsConditions::class)->name('terms-and-conditions');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('/search', Search::class)->name('search');

Route::get('/category/{category:slug}', Category::class)->name('by-category');
Route::get('/location/{location:slug}', Location::class)->name('by-location');
Route::get('/author/{user:slug}', Author::class)->name('author');
Route::get('/article/{article:slug}', Article::class)->name('article');
Route::get('/all-news', AllNews::class)->name('all-news');

