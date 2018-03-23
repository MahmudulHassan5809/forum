<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;


class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('discuss');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'channel_id'=>'required'
        ]);
       $discussion= Discussion::create([

            'title' => $request->title,
            'content' => $request->content,
            'channel_id'=>$request->channel_id,
            'user_id'=>Auth::id(),
            'slug'=>str_slug($request->title)
        ]);

        Session::flash('success','Discussion Created Successfully');
        return  redirect()->route('discussion',['slug'=>$discussion->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $id =Auth::id();
        $discussions = Discussion::where('slug',$slug)->where('user_id',$id)->first();
        if(!$discussions){
            $discussions = Discussion::where('slug',$slug)->first();
            $best_answers = $discussions->replies()->where('best_answer',1)->paginate(3);
        }else {
            $best_answers = $discussions->replies()->where('best_answer', 1)->paginate(3);
        }

        return view('discussions.show',compact('best_answers','discussions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $discussion = Discussion::where('slug',$slug)->first();
        return view('discussions.edit',compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[

            'content'=>'required'

        ]);

        $d = Discussion::find($id);

        $d->content = $request->content;


        $d->save();
        Session::flash('success','Discussion Updated Successfully');
        return  redirect()->route('discussion',['slug'=>$d->slug]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply($id){

        $this->validate(request(),[
            'content'=>'required',

        ]);


        $d = Discussion::find($id);



        $reply = Reply::create([

            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->content,
        ]);

        $reply->user->points += 25 ;
        $reply->user->save();
        $watchers = array();

        foreach ($d->watchers as $watcher){

            array_push($watchers,User::find($watcher->user_id));

        }

        Notification::send($watchers,new \App\Notifications\NewReplyAdded($d));



        Session::flash('success','Reply Created Successfully');
        return  redirect()->back();

    }




}
