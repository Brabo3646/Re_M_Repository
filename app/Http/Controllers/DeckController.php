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
        $deck->name = $request->name;
        $deck->creator_id = Auth::id();
        $deck->description = $request->description;
        $deck->quiztype = $request->quiztype;
        $deck->save();
        
        $deck->users()->attach(Auth::id());
        
        return view('home.index');
    }
    
    public function search()
    {
        return view('deck.search');
    }
}
