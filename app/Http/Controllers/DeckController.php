<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;
use App\Models\Deck;
use App\Models\Quiz;
use App\Models\User;
use App\Http\Requests\DeckRequest;


class DeckController extends Controller
{
    // 新しいデッキを作成する画面
    public function newdeck()
    {
        return view('deck.newdeck');
    }
    
    // 新しいデッキを作成
    public function create(DeckRequest $request)
    {
        $deck = new Deck();
        $deck->deck_name = $request->deck_name;
        $deck->description = $request->description;
        $deck->creator_id = Auth::id();
        $deck->save();
        
        $deck->users()->attach(Auth::id());
            // これにより、作成したデッキを作成者が所有
        return redirect()->route('deck.check.list');
    }
    
    // 自身が作成したデッキの一覧画面
    public function check_list()
    {
        $query = Deck::where('creator_id', '=', Auth::user()->id);
        // デッキの編集画面であるため、自ら作成したデッキのみ表示
        if(!empty(request('search'))) {
            $search = request('search');
            $query = $query->where('deck_name', 'LIKE', '%'.$search.'%');
        }
        $decks = $query->get();
            return view('deck.check.check_list')
                ->with(["decks" => $decks]);
    }
    
    // デッキの中身を確認する画面
    public function check($id)
    {    
        $query = Quiz::where('deck_id', '=', $id);
        if(!empty(request('search'))) {
            $search = request('search');
            $query = $query->where('question', 'LIKE', '%'.$search.'%');
        }
        $quizzes = $query->get();
        return view('deck.check.check')
            ->with (["quizzes" => $quizzes, "id" => $id]);
    }
    
    // デッキを削除
    public function destory($id)
    {
        $deck = Deck::find($id);
        $deck->delete();
        
        return redirect()->route('deck.check.list');
    }
    
    // 回答できるデッキの一覧画面
    public function answer_list()
    {
        $decks = Auth::user()->decks;
        // オファー待ちのデッキは表示されない
        if(!empty(request('search'))) {
            //ログインユーザーに紐づいたデッキのIDを配列として一旦保存する
            $deck_id = array();
            foreach($decks as $deck){
                array_push($deck_id, $deck->id);
            }
            $search = request('search');
            //まず、デッキをログインしたユーザーのIDと合致するかで絞り込み、その後検索ワードで絞り込む
            $decks = Deck::whereIn('id', $deck_id)->where('deck_name', 'LIKE', '%'.$search.'%')->get();
        }
            return view('deck.answer.answer_list')
                ->with(["decks" => $decks]);
    }
    
    // 回答する画面
    public function answer($id)
    {
        $deck = Deck::find($id);
        $quizzes = $deck->quizzes;
        $shuffled_quizzes = $quizzes->shuffle();
        $quiz_count = count($shuffled_quizzes);
        $user_id = Auth::id();
        return view('deck.answer.answer')
            ->with(["quizzes" => $shuffled_quizzes, "quiz_count" => $quiz_count, "user_id" => $user_id, "deck_id" => $id]);
    }
    public function result($id)
    {
        $user = Auth::user();
        if(!$user->deck_exist($id)){
            return view('error.error_deck');
        }
        $deck = Deck::find($id);
        $quiz_id = $deck->quizzes->pluck('id')->toArray();
        $answered_quizzes = $user->quizzes()->whereIn('id', $quiz_id)->get();
        return view('deck.answer.result')
            ->with(["deck" => $deck, "quizzes" => $answered_quizzes]);
    }
    
    // 共有可能なデッキの一覧画面
    public function share_list()
    {
        $query = Deck::where('creator_id', '=', Auth::user()->id);
        // デッキの共有画面であるため、自ら作成したデッキのみ表示
        if(!empty(request('search'))) {
            $search = request('search');
            $query = $query->where('deck_name', 'LIKE', '%'.$search.'%');
        }
        $decks = $query->get();
            return view('deck.share.share_list')
                ->with(["decks" => $decks]);
    }
    
    // デッキを共有する相手を選ぶ画面
    public function share($id)
    {
        $deck = Deck::find($id);
        $avatars = Auth::user()->follow()->get();
        return view('deck.share.share')
            ->with(["deck" => $deck, "avatars" => $avatars]);
    }
    
    // デッキを共有する処理
    public function share_confirm()
    {   
        $deck_id = request("deck_id");
        $deck = Deck::find($deck_id);
        $user = User::find(request("user_id"));
        if(!$user->offered_decks()->where("deck_id", "=", $deck_id)->get()->isEmpty()
            or 
           !$user->decks()->where("deck_id", "=", $deck_id)->get()->isEmpty()){
            return redirect()->route('deck.share.list');
        }
        // デッキを所有済み、または共有オファー済みの場合、何もしないでもどる
        $user->offered_decks()->attach($deck,["crew_offer" => true]);
        return redirect()->route('user.home');
    }
    public function group_add($id)
    {
        $deck = Deck::find($id);
        $user = Auth::user();
        $deck->users()->attach($user);
        $group_id = request("group_id");
        return redirect()->route('group.list');
    }
    public function offer_confirm()
    {
        $deck_id = request("deck_id");
        $deck = Deck::find($deck_id);
        $user = User::find(request("user_id"));
        $user->offered_decks()->updateExistingPivot($deck_id, ['crew_offer' => false]);
        return redirect()->route('user.home');
    }
    public function offer_refuse()
    {
        $deck_id = request("deck_id");
        $deck = Deck::find($deck_id);
        $user = User::find(request("user_id"));
        $user->decks()->detach($deck_id);
        return redirect()->route('user.home');
    }
}