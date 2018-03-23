@extends('layouts.app')

@section('content')


    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{$discussions->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
            <span>{{$discussions->user->name}}--Points:<b>{{$discussions->user->points}}</b> </span>
            @if($discussions->user->id == Auth::id())
                @if(!$discussions->hasBestAnswer())
                    <a href="{{route('discussions.edit',['slug'=>$discussions->slug])}}" class="btn btn-success btn-xs pull-right">Edit</a>
                @endif
            @endif

            @if($discussions->is_being_watched_by_auth_user())

                <a href="{{route('discussion.unwatch',['id'=>$discussions->id])}}" class="btn btn-success btn-xs pull-right">UnWatch</a>

            @else

                <a href="{{route('discussion.watch',['id'=>$discussions->id])}}" class="btn btn-success btn-xs pull-right">Watch</a>

            @endif

        </div>
        <div class="panel-body">
            <h3 class="text-center">
                {{$discussions->title}}
            </h3>
            <hr>
            <hr>
            <p class="text-center">
               {!!  Markdown::convertToHtml($discussions->content) !!}
            </p>

            <hr>
            @if(count($best_answers) > 0 )
            @foreach($best_answers as $best_answer)
               <div class="text-center">
                   <h3 class="text-center">Best Answers</h3>
                   <div class="panel panel-success">
                       <div class="panel-heading">
                           <img src="{{$best_answer->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
                           <span>{{$best_answer->user->name}}--Points:<b>{{$best_answer->user->points}}</b></span>
                       </div>
                       <div class="panel-body">
                           {{$best_answer->content}}
                       </div>
                   </div>
               </div>

              @endforeach
                <div class="text-center">
                    {{$best_answers->links()}}
                </div>
            @endif
        </div>
        <div class="panel-footer">
            <span>
                {{$discussions->replies->count()}} Replies
             </span>
     <a href="{{route('channel',['slug'=>$discussions->channel->slug])}}"><button class="pull-right btn btn-primary btn-xs">{{$discussions->channel->title}}</button></a>
         </div>
      </div>

     @if(count($discussions->replies)>0)
    @foreach($discussions->replies as $reply)

        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$reply->user->avatar}}" alt="" width="40px" height="40px">&nbsp;
                <span>{{$reply->user->name}},--Points:<b>{{$reply->user->points}}</b>> </span>

                @if($reply->best_answer !=1)
                    @if(Auth::id()==$discussions->user->id)
                <span><a href="{{route('discussion.best.answer',['id'=>$reply->id])}}" class="btn btn-xs btn-success">Mark As Best Answer</a></span>
                    @endif

                    @if(Auth::id()==$reply->user_id)
                      <span><a href="{{route('reply.edit',['id'=>$reply->id])}}" class="btn btn-xs btn-success">Edit Reply</a></span>
                    @endif
                @endif
            </div>
            <div class="panel-body">

                <p class="text-center">
                    {!! Markdown::convertToHtml($reply->content) !!}
                </p>
            </div>
            <div class="panel-footer">
                <p>
                    @if($reply->is_liked_by_auth_user())

                        <a href="{{route('reply.unlike',['id'=>$reply->id])}}" class="btn btn-danger">Unlike <span class="badge">{{$reply->likes->count()}}</span></a>

                     @else

                        <a href="{{route('reply.like',['id'=>$reply->id])}}" class="btn btn-success">Like <span class="badge">{{$reply->likes->count()}}</span></a>

                    @endif
                </p>
            </div>
        </div>
    @endforeach
     @else
      No replies Found
    @endif

    <div class="panel panel-default">
        @if(Auth::check())
        <div class="panel-body">
            {!! Form::open(['route' => ['discussion.reply','id'=>$discussions->id],'method'=>'POST']) !!}

            <div class="form-group">
                {!! Form::label('content','Leave A Reply:') !!}
                {!! Form::textarea('content',null,['class'=>'form-control' ,'id'=>'content','rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Reply',['class'=>'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>
         @else
            <div class="text-center">
                <h2>Sign in To Leave A Comment</h2>
            </div>
         @endif
    </div>

@endsection
