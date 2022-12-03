<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $nbShow = 3;
        $user = User::find(Auth::id());
        // $user = Auth::user(); // This is the same as the line above, but VSC doesn't did the type casting to User, so no intellisense

        if ($user){
            $lends = $user->lends()->orderby("deadline")->take($nbShow)->get();
            $borrows = $user->borrows()->orderby("deadline")->take($nbShow)->get();
        }

        return view('home',  [
            'user' => $user,
            'lends' => $lends ?? null,
            'borrows' => $borrows ?? null,
        ]);
    }
}
