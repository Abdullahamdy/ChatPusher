<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   public function chat(){
       return view('chat');
   }

   public function send(request $request){
       $user = User::find(Auth::id());
       $this->saveToSession($request);
       event(new ChatEvent($request->message,$user));
   }


    public function saveToSession(request $request){

        session()->put('chat', $request->chat);
    }
    public function getOldMessage(){

        return session('chat');
    }
    public function DeleteSession(){
        session()->forget('chat');
    }

}
