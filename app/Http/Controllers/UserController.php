<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avater;
use App\Models\Deck;
use App\Models\User;

class UserController extends Controller
{
    public function home(Request $request, User $user)
    {
        $offered_decks = Auth::user()->decks()->wherePivot('crew_offer', true)->get();
        foreach($offered_decks as $offered_deck){
            $creator_id = $offered_deck->creator_id;
            // 共有されたデッキの作成者のIDを取得
            $avater_name = Avater::where('user_id', '=', $creator_id)->first()->avater_name;
            // そのIDを持つアバターの名前を取得
            $offered_deck->offer_avater_name = $avater_name;
            // デッキに作成者のアバター名を記述、bladeファイルに転送
            }
        $user_id = Auth::user()->id;
        return view('home.index')
            ->with(["offered_decks" => $offered_decks, "user_id" => $user_id]);
    }
}
