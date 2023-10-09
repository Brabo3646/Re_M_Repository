<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;
use App\Models\Deck;
use App\Http\Requests\AvatarRequest;

class AvatarController extends Controller
{
    public function share_avatar_exist()
    {   $user_id = Auth::user()->id;
        if(!Avatar::where('user_id', '=', $user_id)->exists()){
            return redirect()->route('avatar.newavatar', "share");
        }
        // アバターを未作成ならば、作成画面に飛ばす
        return redirect()->route('deck.share.list');
    }
        public function group_avatar_exist()
    {   $user_id = Auth::user()->id;
        if(!Avatar::where('user_id', '=', $user_id)->exists()){
            return redirect()->route('avatar.newavatar', "group");
        }
        // アバターを未作成ならば、作成画面に飛ばす
        return redirect()->route('group.list');
    }
    public function newavatar($route)
    {
        return view ('avatar.newavatar')
            ->with(["route" => $route]);
    }
    public function create($route, avatarRequest $request)
    {
        $avatar = new Avatar();
        $avatar->user_id = Auth::user()->id;
        $avatar->avatar_name = $request->avatar_name;
        $avatar->avatar_ID = $request->avatar_ID;
        $avatar->introduce = $request->introduce;
        if ($request->searchable === "able"){
            $avatar->searchable = true;
        } else {$avatar->searchable = false;}
        $avatar->save();
        if($route === "share"){
            return redirect()->route('deck.share.list');
        } else {
            return redirect()->route('group.list');
        }
        
    }
    public function edit()
    {
        $user_id = Auth::user()->id;
        $avatar = Avatar::find($user_id);
        return view('avatar.avatar_edit')
            ->with(["avatar" => $avatar]);
    }
    public function update(avatarRequest $request)
    {
        $user_id = Auth::user()->id;
        $avatar = Avatar::find($user_id);
        $avatar->avatar_name = $request->avatar_name;
        $avatar->avatar_ID = $request->avatar_ID;
        $avatar->introduce = $request->introduce;
        if ($request->searchable === "able"){
            $avatar->searchable = true;
        } else {$avatar->searchable = false;}
        $avatar->save();
        return redirect()->route('profile.edit');
    }
    public function crew_add($route)
    // 所謂フレンド登録
    {   
        if(!empty(request('search'))) {
            $search = request('search');
            if (Avatar::where('avatar_ID', '=', $search)->exists()){
                $avatar = Avatar::where('avatar_ID', '=', $search)->first();
            } else {
                $avatar = 'nohit';
            }
        } else {
            $avatar = null;
        }
        $id = Auth::user()->id;
        // 自身のアバターを検索しても登録できないようにするため
        return view('crew.add')
            ->with(["avatar" => $avatar, "id" => $id, "route" => $route]);
    }
    public function crew_register($route)
    {   
        $avatar = Avatar::find(request('user_id'));
        $avatar->users()->attach(Auth::id());
        if($route === "group"){
            return redirect()->route('group.list');
        } else {
            return redirect()->route('deck.share.list');
        }
        
    }
}
