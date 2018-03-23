<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\paginator;

class ForumsController extends Controller
{
    //
     public function index(){

        // $discussion = Discussion::orderBy('created_at','desc')->paginate(3);
         switch(request('filter')){

             case 'me' :
                 $discussion = Discussion::where('user_id',Auth::id())->paginate(3);
                 break ;

             case 'solved' :
                 $answered = array();
                 foreach (Discussion::all() as $d){

                     if($d->hasBestAnswer()){
                        array_push($answered,$d);
                     }
                 }
                 $discussion = new Paginator($answered,3);
                 break ;

             case 'unsolved' :
                 $unanswered = array();
                 foreach (Discussion::all() as $d){

                     if(!$d->hasBestAnswer()){
                         array_push($unanswered,$d);
                     }
                 }
                 $discussion = new Paginator($unanswered,3);
                 break ;

             default: $discussion = Discussion::orderBy('created_at','desc')->paginate(3);
                 break;

         }
         return view('forum',compact('discussion'));
     }

     public  function  channel($slug){
         $channel = Channel::where('slug',$slug)->first();
         $discussion = $channel->discussions()->paginate(5) ;
         return view('channel',compact('discussion'));
     }
}
