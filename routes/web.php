<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThoughtController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    session()->forget('results');
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search' , function () {
    session()->forget('results');
    return Inertia::render('Search/Index');
})->middleware(['auth', 'verified'])->name('search');

// If the user tries to access the search results page without searching, or refreshes the search results page, redirect them to the search page
Route::get('/search/results', function () {
    // Check if there is data in the session
    if (session()->has('results')) {
        // If there is, render the results page
        return Inertia::render('Search/Results', ['results' => session('results')]);
    } else {
        // If there isn't, redirect to the search page
        return redirect()->route('search')->with('message', 'Your session has expired. Please perform a new search.');
    }
})->middleware(['auth', 'verified'])->name('search/results');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('thoughts', ThoughtController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

/* Thought Controller GET Routes */
Route::get('/thoughts', [ThoughtController::class, 'index'])->middleware(['auth', 'verified'])->name('thoughts.index');
Route::get('/drafts', [ThoughtController::class, 'drafts'])->middleware(['auth', 'verified'])->name('thoughts.drafts');
Route::get('/deleted', [ThoughtController::class, 'deleted'])->middleware(['auth', 'verified'])->name('thoughts.deleted');

/* Thought Controller POST Routes */
Route::post('thoughts.updateStatus', [ThoughtController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('thoughts.updateStatus');
Route::post('search/results', [ThoughtController::class, 'search'])->middleware(['auth', 'verified'])->name('search/results');
require __DIR__.'/auth.php';
