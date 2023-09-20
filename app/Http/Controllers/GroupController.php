<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Deck;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GroupRequest;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function group_list()
    // 所属するグループの一覧
    {
        $avatar = Auth::user()->avatar;
        $groups = $avatar->groups;
        return view('group.group_list')
            ->with(["avatar" => $avatar, "groups" => $groups]);
    }
    

    public function group_members($id)
    // グループに所属するメンバーの一覧
    {
        $group = Group::find($id);
        $members = $group->members;
        return view('group.members')
            ->with(["group" => $group, "members" => $members]);
    }
    
    public function add_member($id)
    // クルーをメンバーに招待する画面
    {
        $follows_id = Auth::user()->follow->pluck('user_id')->all();
        $members_id = Group::find($id)->allmembers->pluck('user_id')->all();
        $listed_crews_id = array_diff($follows_id, $members_id);
        // 登録できるアバターは、招待されていないクルーかつグループのメンバーでない
        $listed_crews = Avatar::whereIn('user_id', $listed_crews_id)->get();
        $group = Group::find($id);
        return view('group.add_member')
            ->with(["group" => $group, "listed_crews" => $listed_crews]);
    }
    
    public function add_member_confirm()
    // 招待を送る
    {   $id = request('group_id');
        $user_id = request('user_id');
        $group = Group::find($id);
        if(!$group->members()->where("user_id", "=", $user_id)->get()->isEmpty()){
            return redirect()->route('deck.share.list');
        }
        $invite_user_id = Auth::user()->id;
        $group->members()->attach($user_id,["invite_user_id" => $invite_user_id]);
        return redirect()->route('group.list');
    }
    public function invited_confirm()
    // 招待を承諾する
    {
        $group_id = request("group_id");
        $group = Group::find($group_id);
        $avatar = Avatar::find(request("user_id"));
        $avatar->invited_groups()->updateExistingPivot($group_id, ['invite_user_id' => 0]);
        $group->member_count ++;
        $group->save();
        // ここで初めてグループのメンバー数が１足される
        return redirect()->route('user.home');
    }
    public function invited_refuse()
    // 招待を拒否する
    {
        $group_id = request("group_id");
        $group = Group::find($group_id);
        $avatar = Avatar::find(request("user_id"));
        $avatar->groups()->detach($group_id);
        return redirect()->route('user.home');
    }
    public function group_decks($id)
    {
        $group = Group::find($id);
        $decks = $group->decks;
        return view('group.group_decks')
            ->with(["group" => $group, "decks" => $decks]);
    }
    public function group_share_list()
    {
        $group = Group::find(request("group_id"));
        $query = Deck::where('creator_id', '=', Auth::user()->id);
        // デッキの共有画面であるため、自ら作成したデッキのみ表示
        if(!empty(request('search'))) {
            $search = request('search');
            $query = $query->where('deck_name', 'LIKE', '%'.$search.'%');
        }
        $decks = $query->get();
        return view('group.group_share_list')
            ->with(["group" => $group, "decks" => $decks]);
    }
        
    public function group_share()
    {
        $group = Group::find(request("group_id"));
        $group->decks()->attach(request('deck_id'));
        return redirect()->route('group_decks',$group->id);
    }
    public function newgroup()
    {
        $avatar = Auth::user()->avatar;
        return view('group.newgroup')
            ->with(["avatar" => $avatar]);
    }
    public function create(GroupRequest $request)
    {
        $group = new Group();
        $group->group_name = $request->group_name;
        $group->description = $request->description; 
        $group->member_count ++;
        $group->save();
        
        $avatar = Auth::user()->avatar;
        $group->members()->attach($avatar->user_id,["admin" => true]);
        // グループを作ったユーザーのアバターは、自動的にグループへ加盟する
        return redirect()->route('group.list');
    }
}
