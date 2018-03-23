@extends('layouts.app')

@section('content')


        @include('errors.error')

                <div class="panel panel-default">
                    <div class="panel-heading">Create A new Channel</div>

                    {{--form open--}}
                    <div class="col-md-6">
                        {!! Form::model($channelById,['method'=>'PATCH','route'=>['channels.update',$channelById->id],'files'=>true,]) !!}


                        <div class="form-group">
                            {!! Form::label('title','Name:') !!}
                            {!! Form::text('title',$channelById->title,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Update Chanel',['class'=>'btn btn-info']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                    {{--form close--}}
                </div>


@endsection
