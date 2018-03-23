@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            @foreach($discussion as $discus)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{$discus->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
                        <span>{{$discus->user->name}},<b>{{$discus->created_at->diffForHumans()}}</b> </span>
                        <a href="{{route('discussion',['slug'=>$discus->slug])}}" class="btn btn-success pull-right">View</a>

                    </div>
                    <div class="panel-body">
                        <h3 class="text-center">
                            {{$discus->title}}
                        </h3>
                        <p class="text-center">
                            {{str_limit($discus->content,50)}}
                        </p>
                    </div>
                    <div class="panel-footer">
                        <p>
                            {{$discus->replies->count()}} Replies
                        </p>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    <div class="text-center">
        {{$discussion->links()}}
    </div>


@endsection
