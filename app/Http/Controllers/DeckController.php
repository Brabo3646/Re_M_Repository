<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Deck;
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
        
        return view('home.index');
    }
    
    public function list()
    {
        $decks = Auth::user()->decks;
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
            return view('deck.list')
                ->with(["decks" => $decks]);
    }
    function check(Deck $deck)
    {
        return view('deck.check')
            ->with (["decks" => $decks]);
    }
}