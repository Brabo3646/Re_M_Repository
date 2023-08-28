<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avater;
use App\Models\Deck;
use App\Http\Requests\AvaterRequest;

class AvaterController extends Controller
{
    public function share_avater_exist()
    {   $user_id = Auth::user()->id;
        if(!Avater::where('user_id', '=', $user_id)->exists()){
            return redirect()->route('avater.newavater');
        }
        // アバターを未作成ならば、作成画面に飛ばす
        return redirect()->route('deck.share.list');
    }
    public function newavater()
    {
        return view ('avater.newavater');
    }
    public function create(AvaterRequest $request)
    {
        $avater = new Avater();
        $avater->user_id = Auth::user()->id;
        $avater->avater_name = $request->avater_name;
        $avater->avater_ID = $request->avater_ID;
        $avater->introduce = $request->introduce;
        if ($request->searchable === "able"){
            $avater->searchable = true;
        } else {$avater->searchable = false;}
        $avater->save();
        return redirect()->route('deck.share.list');
    }
    public function crew_add()
    {   
        if(!empty(request('search'))) {
            $search = request('search');
            if (Avater::where('avater_ID', '=', $search)->exists()){
                $avater = Avater::where('avater_ID', '=', $search)->first();
            } else {
                $avater = 'nohit';
            }
        } else {
            $avater = null;
        }
        $id = Auth::user()->id;
        // 自身のアバターを検索しても登録できないようにするため
        return view('crew.add')
            ->with(["avater" => $avater, "id" => $id]);
    }
    public function crew_register()
    {   
        $avater = Avater::find(request('user_id'));
        $avater->users()->attach(Auth::id());
        return redirect()->route('deck.share.list');
        
    }
}
