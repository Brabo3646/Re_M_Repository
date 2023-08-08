<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeckController;
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

Route::get('/',[UserController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('user.home');
    
Route::get('/deck/newdeck',[DeckController::class, 'newdeck'])
    ->middleware(['auth', 'verified'])
    ->name('deck.newdeck');
    
Route::post('/deck/create',[DeckController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('deck.create');
Route::get('/deck/search',[DeckController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('deck.search');
Route::get('/deck/check',[DeckController::class, 'check'])
    ->name('deck.check');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
