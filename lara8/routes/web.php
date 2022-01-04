<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UserLC;
use App\Http\Livewire\TeamLC;
use App\Http\Livewire\ArticleLC;
use App\Http\Livewire\CategoryLC;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('about', function () {
        return view('about');
    })->name('about');

    Route::get('users', UserLC::class)->name('users');
    Route::get('teams', TeamLC::class)->name('teams');
    Route::get('categories', CategoryLC::class)->name('categories');
    Route::get('articles', ArticleLC::class)->name('articles');
    Route::get('articles/{article}', [ArticleLC::class, 'details']);

});

