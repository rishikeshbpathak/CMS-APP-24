<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageBackendController;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/page-viewer');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// backend pages routes
    Route::get('/dashboard/pages', [PageBackendController::class, 'index'])->name('pages.index');
    Route::get('/dashboard/pages/create', [PageBackendController::class, 'create'])->name('pages.create');
    Route::post('/dashboard/pages/store', [PageBackendController::class, 'store'])->name('pages.store');
    Route::get('/dashboard/pages/edit/{page}', [PageBackendController::class, 'edit'])->name('pages.edit');
    Route::put('/dashboard/pages/edit/update/{page}', [PageBackendController::class, 'update'])->name('pages.update');
    Route::delete('/dashboard/pages/delete/{page}', [PageBackendController::class, 'destroy'])->name('pages.destroy');
});


Route::get('/pages', [PageController::class, 'index']);
Route::get('/page-viewer', [PageController::class, 'showPageViewer']);
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '.*');

require __DIR__.'/auth.php';
