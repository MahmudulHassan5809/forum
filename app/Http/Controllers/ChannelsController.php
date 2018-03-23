<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChannelsController extends Controller
{


    public function __construct(){

        $this->middleware('admin');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $channels = Channel::all();
        return view('channels.index',compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('channels.create');
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


        ]);

        Channel::create([

           'title' => $request->title,
           'slug' => str_slug($request->title)

        ]);

        Session::flash('success','Channel Created Successfully');
       return  redirect()->route('channels.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $channelById = Channel::find($id);


        return view('channels.edit',compact('channelById'));
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
            'title'=>'required',
        ]);
        $channel = Channel::find($id);

        $channel->title = $request->title;
        $channel->slug = str_slug($request->title);

        $channel->save();

        Session::flash('success','Channel Updated Successfully');
        return  redirect()->route('channels.index');
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
        $channel = Channel::find($id);
        $channel->delete();

        Session::flash('success','Channel is Successfully Trashed');

        return redirect()->back();
    }
}
