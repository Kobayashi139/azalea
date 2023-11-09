<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ReviewController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Route::get('/index', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/', [ReviewController::class, 'review'])->name('maps.map');
    Route::get('/reviews/create/{name}',[ReviewController::class, 'create']);
    Route::get('/maps/show/{review}',[ReviewController::class , 'show']);
    Route::post('/reviews',[ReviewController::class, 'store']);
    Route::get('/reviews/{review}/edit',[ReviewController::class, 'edit']);
    Route::put('/reviews/{review}',[ReviewController::class, 'update']);
    
    Route::post('/search', [ReviewController::class, 'search'])->name('review.search');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
