<?php

use App\Livewire\Homepage;
use App\Livewire\Library;
use App\Livewire\Search;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('search', Search::class)->name('search');
    Route::get('library', Library::class)->name('library');
    Route::get('library/authors', \App\Livewire\Library\Authors::class)->name('library.authors');
    Route::get('library/books', \App\Livewire\Library\Books::class)->name('library.books');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
