@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Update A  Reply</div>

        <div class="panel-body">
            {!! Form::model($reply,['method'=>'PATCH','route'=>['reply.update',$reply->id],'files'=>true,]) !!}

            <div class="form-group">
                {!! Form::label('content','Content:') !!}
                {!! Form::textarea('content',$reply->content,['class'=>'form-control' ,'id'=>'content','rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Reply',['class'=>'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
