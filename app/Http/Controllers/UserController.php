<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function home(Request $request, User $user)
    {
        return view('home.index')
        ->with(['user' => $user]);
    }
}
