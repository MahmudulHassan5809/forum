<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    //

    public function like($id){

        $reply = Reply::find($id);

        Like::create([

            'reply_id' => $reply->id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success','You Liked The Reply');
        return  redirect()->back();

    }

    public function unlike($id){

        $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        if (!is_null($like)) {
            $like->delete();
        }

        Session::flash('success','You Unliked The Reply');
        return  redirect()->back();
    }

    public function best_answer($id){

        $reply = Reply::find($id);

        $reply->best_answer = 1;

        $reply->save();

        $reply->user->points += 50 ;
        $reply->user->save();

        Session::flash('success','Marked As Best Answer');
        return  redirect()->back();

    }

   public function edit($id){

       return view('replies.edit',['reply'=>Reply::where('id',$id)->first()]);

   }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[

            'content'=>'required'

        ]);

        $r = Reply::find($id);

        $r->content = $request->content;
        $r->save();
        Session::flash('success','Discussion Updated Successfully');
        return  redirect()->route('discussion',['slug'=>$r->discussion->slug]);

    }

}
