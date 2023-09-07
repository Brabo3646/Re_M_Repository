<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;
use App\Models\Deck;
use App\Models\User;

class UserController extends Controller
{
    public function home(Request $request, User $user)
    {
        // $offered_decks = Auth::user()->offered_decks()
        // ->with('creator') // Eager Loading
        // ->get();
        $offered_decks = Auth::user()->offered_decks;
        foreach($offered_decks as $offered_deck){
            $creator_id = $offered_deck->creator_id;
            // 共有されたデッキの作成者のIDを取得
            $offer_avatar_name = Avatar::where('user_id', '=', $creator_id)->first()->avatar_name;
            // そのIDを持つアバターの名前を取得
            $offered_deck->offer_avatar_name = $offer_avatar_name;
            // デッキに作成者のアバター名を記述、bladeファイルに転送
            }
        $avatar = Auth::user()->avatar;
        if ($avatar){
            $invited_groups = $avatar->invited_groups;
                if($invited_groups){
                foreach($invited_groups as $invited_group){
                    $invite_user_id = $invited_group->pivot->invite_user_id;
                    $invite_avater = Avatar::find($invite_user_id);
                    $invited_group->invite_avater_name = $invite_avater->avatar_name;
                }} else {
                $invited_groups = collect();
                }
        } else {    
            $invited_groups = collect();
        }
        $user_id = Auth::user()->id;
        return view('home.index')
            ->with(["offered_decks" => $offered_decks, "invited_groups" => $invited_groups, "user_id" => $user_id]);
    }
}
