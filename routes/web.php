<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\GroupController;
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
//AvatarController
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/deck/share/avatar',[AvatarController::class, 'share_avatar_exist'])
        ->name('share.avatar.exist');
    Route::get('/avatar/newavatar/{route}',[AvatarController::class, 'newavatar'])
        ->name('avatar.newavatar');
    Route::post('/avatar/create/{route}',[AvatarController::class, 'create'])
        ->name('avatar.create');
    Route::get('/crew/add/{route}',[AvatarController::class, 'crew_add'])
        ->name('crew.add');
    Route::post('/crew/register/{route}',[AvatarController::class, 'crew_register'])
        ->name('crew.register');
    Route::get('/group/avatar',[AvatarController::class, 'group_avatar_exist'])
        ->name('group.avatar.exist');
});
    

//DeckController
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/deck/newdeck',[DeckController::class, 'newdeck'])
        ->name('deck.newdeck');
    Route::post('/deck/create',[DeckController::class, 'create'])
        ->name('deck.create');
    Route::get('/deck/check/list',[DeckController::class, 'check_list'])
        ->name('deck.check.list');
    Route::post('/deck/search',[DeckController::class, 'search'])
        ->name('deck.search');
    Route::get('/deck/check/{id}',[DeckController::class, 'check'])
        ->name('deck.check');
    Route::delete('/deck/destory/{id}', [DeckController::class, 'destory'])
        ->name('deck.destroy');
    Route::get('/deck/answer/list',[DeckController::class, 'answer_list'])
        ->name('deck.answer.list');
    Route::post('/deck/answer/{id}',[DeckController::class, 'answer'])
        ->name('deck.answer')
        ->where('id', '[0-9]+');
    Route::get('/deck/share/list',[DeckController::class, 'share_list'])
        ->name('deck.share.list');
    Route::post('deck/share/confirm',[DeckController::class, 'share_confirm'])
        ->name('deck.share.confirm');
    Route::post('/deck/share/{id}',[DeckController::class, 'share'])
        ->name('deck.share');
    Route::post('/deck/group/{id}',[DeckController::class, 'group_add'])
        ->name('deck.group.add');
    Route::post('/deck/offer/confirm',[DeckController::class, 'offer_confirm'])
        ->name('deck.offer.confirm');
    Route::post('/deck/offer/refuse',[DeckController::class, 'offer_refuse'])
        ->name('deck.offer.refuse');
});
    
//GroupController
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/group/list',[GroupController::class, 'group_list'])
        ->name('group.list');
    Route::post('/group/members/{id}',[GroupController::class, 'group_members'])
        ->name('group.members');
    Route::post('/group/addmember/confirm',[GroupController::class, 'add_member_confirm'])
        ->name('add.member.confirm');
    Route::post('/group/addmember/{id}',[GroupController::class, 'add_member'])
        ->name('add.member');
    Route::post('/group/invited/confirm',[GroupController::class, 'invited_confirm'])
        ->name('group.invited.confirm');
    Route::post('/group/invited/refuse',[GroupController::class, 'invited_refuse'])
        ->name('group.invited.refuse');
    Route::post('/group/decks/{id}',[GroupController::class, 'group_decks'])
        ->name('group.decks');
    Route::post('/group/share/list',[GroupController::class, 'group_share_list'])
        ->name('group.share.list');
    Route::post('/group/share',[GroupController::class, 'group_share'])
        ->name('group.share');
    Route::get('/group/newgroup',[GroupController::class, 'newgroup'])
        ->name('group.newgroup');
    Route::post('/group/create',[GroupController::class, 'create'])
        ->name('group.create');
});
    
//QuizController
    Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/quiz/newquiz/{id}',[QuizController::class, 'newquiz'])
        ->name('quiz.newquiz');
    Route::post('/quiz/create',[QuizController::class, 'create'])
        ->name('quiz.create');
    Route::post('/quiz/edit/{id}',[QuizController::class, 'edit'])
        ->name('quiz.edit');
    Route::patch('/quiz/update/{id}',[QuizController::class, 'update'])
        ->name('quiz.update');
    Route::delete('/quiz/destory/{id}', [QuizController::class, 'destory'])
        ->name('quiz.destroy');
});
// クイズに関するajax処理
    Route::post('/quiz/answer/CE',[QuizController::class, 'CE'])
        ->name('quiz.CE');
        
        
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
