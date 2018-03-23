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
                             @if($discus->user->id == Auth::id())
                                 @if(!$discus->hasBestAnswer())
                                  <a href="{{route('discussions.edit',['slug'=>$discus->slug])}}" class="btn btn-success btn-xs pull-right">Edit</a>
                             @endif
                              @endif
                              @if($discus->hasBestAnswer())

                                  <span class="btn btn-success pull-right btn-xs">Closed</span>
                               @else
                                  <span class="btn btn-danger pull-right btn-xs">Open</span>
                               @endif
                              <a href="{{route('discussion',['slug'=>$discus->slug])}}" class="btn btn-success btn-xs pull-right">View</a>

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
                              <span>
                                 {{$discus->replies->count()}} Replies
                              </span>
                              <a href="{{route('channel',['slug'=>$discus->channel->slug])}}"><button class="pull-right btn btn-primary btn-xs">
                                   {{$discus->channel->title}}
                              </button></a>
                          </div>
                      </div>

                    @endforeach
                </div>
            </div>

          <div class="text-center">
              {{$discussion->links()}}
          </div>


@endsection
