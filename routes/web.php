<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
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

//DeckController
Route::get('/deck/newdeck',[DeckController::class, 'newdeck'])
    ->middleware(['auth', 'verified'])
    ->name('deck.newdeck');
Route::post('/deck/create',[DeckController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('deck.create');
Route::get('/deck/list',[DeckController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('deck.list');
Route::post('/deck/search',[DeckController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('deck.search');
Route::get('/deck/{id}/check',[DeckController::class, 'check'])
    ->middleware(['auth', 'verified'])
    ->name('deck.check');
Route::delete('/deck/{id}/destory', [DeckController::class, 'destory'])
    ->middleware(['auth', 'verified'])
    ->name('deck.destroy');
    
//QuizController
Route::post('/quiz/{id}/newquiz',[QuizController::class, 'newquiz'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.newquiz');
Route::post('/quiz/create',[QuizController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.create');
Route::post('/quiz/{id}/edit',[QuizController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.edit');
Route::patch('/quiz/{id}/update',[QuizController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.update');
Route::delete('/quiz/{id}/destory', [QuizController::class, 'destory'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.destroy');
    
//UserController
Route::get('/',[UserController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('user.home');
    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
