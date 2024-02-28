<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
class HomeController extends Controller
{
    public function index(){
        return view('home.userpage');
    }
    
    public function redirect(){
        $usertype=auth::user()->usertype;

        if($usertype== "1"){

            return view('admin.home');
    }

    else{
        $event=event::all();
        return view('home.userpage', compact('event'));
}
}

public function home(){
    $event=event::all();
    return view('home.userpage',compact('event'));
}
}