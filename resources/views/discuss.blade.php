@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading text-center">Create A new Discussion</div>

                    <div class="panel-body">
                        {!! Form::open(['method'=>'POST','route'=>'discussions.store','files'=>true]) !!}


                        <div class="form-group">
                            {!! Form::label('title','Name:') !!}
                            {!! Form::text('title',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="channel">Pick A channel</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option selected>Choose Option</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}">{{$channel->title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            {!! Form::label('content','Content:') !!}
                            {!! Form::textarea('content',null,['class'=>'form-control' ,'id'=>'content','rows'=>3]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Create Discussion',['class'=>'btn btn-info']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

@endsection
