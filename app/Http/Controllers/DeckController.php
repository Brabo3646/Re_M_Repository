<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('deck.check.check')
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
            return view('deck.answer.answer_list')
                ->with(["decks" => $decks]);
    }
    public function answer($id)
    {
        $deck = Deck::find($id);
        
        return view('deck.answer.answer')
            ->with(["deck" => $deck]);
        
    }
}