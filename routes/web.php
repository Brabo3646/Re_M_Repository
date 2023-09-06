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
Route::get('/deck/share/avatar',[AvatarController::class, 'share_avatar_exist'])
    ->middleware(['auth', 'verified'])
    ->name('share.avatar.exist');
Route::get('/avatar/newavatar/{route}',[AvatarController::class, 'newavatar'])
    ->middleware(['auth', 'verified'])
    ->name('avatar.newavatar');
Route::post('/avatar/create/{route}',[AvatarController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('avatar.create');
Route::get('/crew/add/{route}',[AvatarController::class, 'crew_add'])
    ->middleware(['auth', 'verified'])
    ->name('crew.add');
Route::post('/crew/register/{route}',[AvatarController::class, 'crew_register'])
    ->middleware(['auth', 'verified'])
    ->name('crew.register');
Route::get('/group/avatar',[AvatarController::class, 'group_avatar_exist'])
    ->middleware(['auth', 'verified'])
    ->name('group.avatar.exist');
    

//DeckController
Route::get('/deck/newdeck',[DeckController::class, 'newdeck'])
    ->middleware(['auth', 'verified'])
    ->name('deck.newdeck');
Route::post('/deck/create',[DeckController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('deck.create');
Route::get('/deck/check/list',[DeckController::class, 'check_list'])
    ->middleware(['auth', 'verified'])
    ->name('deck.check.list');
Route::post('/deck/search',[DeckController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('deck.search');
Route::get('/deck/check/{id}',[DeckController::class, 'check'])
    ->middleware(['auth', 'verified'])
    ->name('deck.check');
Route::delete('/deck/destory/{id}', [DeckController::class, 'destory'])
    ->middleware(['auth', 'verified'])
    ->name('deck.destroy');
Route::get('/deck/answer/list',[DeckController::class, 'answer_list'])
    ->middleware(['auth', 'verified'])
    ->name('deck.answer.list');
Route::post('/deck/answer/{id}',[DeckController::class, 'answer'])
    ->middleware(['auth', 'verified'])
    ->name('deck.answer')
    ->where('id', '[0-9]+');
Route::get('/deck/share/list',[DeckController::class, 'share_list'])
    ->middleware(['auth', 'verified'])
    ->name('deck.share.list');
Route::post('deck/share/confirm',[DeckController::class, 'share_confirm'])
    ->middleware(['auth', 'verified'])
    ->name('deck.share.confirm');
Route::post('/deck/share/{id}',[DeckController::class, 'share'])
    ->middleware(['auth', 'verified'])
    ->name('deck.share');
Route::post('/deck/group/{id}',[DeckController::class, 'group_add'])
    ->middleware(['auth', 'verified'])
    ->name('deck.group.add');
Route::post('/deck/offer/confirm',[DeckController::class, 'offer_confirm'])
    ->middleware(['auth', 'verified'])
    ->name('deck.offer.confirm');
Route::post('/deck/offer/refuse',[DeckController::class, 'offer_refuse'])
    ->middleware(['auth', 'verified'])
    ->name('deck.offer.refuse');
    
//GroupController
Route::get('/group/list',[GroupController::class, 'group_list'])
    ->middleware(['auth', 'verified'])
    ->name('group.list');
Route::post('/group/members/{id}',[GroupController::class, 'group_members'])
    ->middleware(['auth', 'verified'])
    ->name('group.members');
Route::post('/group/addmember/confirm',[GroupController::class, 'add_member_confirm'])
    ->middleware(['auth', 'verified'])
    ->name('add.member.confirm');
Route::post('/group/addmember/{id}',[GroupController::class, 'add_member'])
    ->middleware(['auth', 'verified'])
    ->name('add.member');
Route::post('/group/invited/confirm',[GroupController::class, 'invited_confirm'])
    ->middleware(['auth', 'verified'])
    ->name('group.invited.confirm');
Route::post('/group/invited/refuse',[GroupController::class, 'invited_refuse'])
    ->middleware(['auth', 'verified'])
    ->name('group.invited.refuse');
    
Route::post('/group/decks/{id}',[GroupController::class, 'group_decks'])
    ->middleware(['auth', 'verified'])
    ->name('group.decks');
Route::post('/group/share/list',[GroupController::class, 'group_share_list'])
    ->middleware(['auth', 'verified'])
    ->name('group.share.list');
Route::post('/group/share',[GroupController::class, 'group_share'])
    ->middleware(['auth', 'verified'])
    ->name('group.share');

Route::get('/group/newgroup',[GroupController::class, 'newgroup'])
    ->middleware(['auth', 'verified'])
    ->name('group.newgroup');
Route::post('/group/create',[GroupController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('group.create');

    
//QuizController
Route::post('/quiz/newquiz/{id}',[QuizController::class, 'newquiz'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.newquiz');
Route::post('/quiz/create',[QuizController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.create');
Route::post('/quiz/edit/{id}',[QuizController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.edit');
Route::patch('/quiz/update/{id}',[QuizController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.update');
Route::delete('/quiz/destory/{id}', [QuizController::class, 'destory'])
    ->middleware(['auth', 'verified'])
    ->name('quiz.destroy');
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
