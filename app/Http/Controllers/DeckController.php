<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avater;
use App\Models\Deck;
use App\Models\Quiz;
use App\Models\User;
use App\Http\Requests\DeckRequest;


class DeckController extends Controller
{
    public function newdeck()
    {
        return view('deck.newdeck');
    }
    
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
    
    public function check_list()
    {
        $query = Deck::where('creator_id', '=', Auth::user()->id);
        // デッキの編集画面であるため、自ら作成したデッキのみ表示
        if(!empty(request('search'))) {
            $query = $query->where('deck_name', 'LIKE', '%'.$search.'%');
        }
        $decks = $query->get();
            return view('deck.check.check_list')
                ->with(["decks" => $decks]);
    }
    public function check($id)
    {    
        $query = Quiz::where('deck_id', '=', $id);
        if(!empty(request('search'))) {
            $search = request('search');
            $query = $query->where('question', 'LIKE', '%'.$search.'%');
        }
        $quizzes = $query->get();
        return view('deck.browse.check')
            ->with (["quizzes" => $quizzes, "id" => $id]);
    }
    public function destory($id)
    {
        $deck = Deck::find($id);
        $deck->delete();
        
        return redirect()->route('deck.check.list');
    }
    
    public function answer_list()
    {
        $decks = Auth::user()->decks()->wherePivot('crew_offer', false)->get();
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
    public function answer($id)
    {
        $deck = Deck::find($id);
        
        return view('deck.answer.answer')
            ->with(["deck" => $deck]);
        
    }
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
    public function share($id)
    {
        $deck = Deck::find($id);
        $avaters = Auth::user()->follow()->get();
        return view('deck.share.share')
            ->with(["deck" => $deck, "avaters" => $avaters]);
    }
    public function share_confirm()
    {   
        $deck_id = request("deck_id");
        $deck = Deck::find($deck_id);
        $user = User::find(request("user_id"));
        if(!$user->decks()->where("deck_id", "=", $deck_id)->get()->isEmpty()){
            return redirect()->route('deck.share.list');
        }
        $deck->users()->attach($user,["crew_offer" => true]);
        return redirect()->route('user.home');
    }
    public function offer_confirm()
    {
        $deck_id = request("deck_id");
        $deck = Deck::find($deck_id);
        $user = User::find(request("user_id"));
        $user->decks()->updateExistingPivot($deck_id, ['crew_offer' => false]);
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