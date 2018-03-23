@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">Update A  Discussion</div>

        <div class="panel-body">
            {!! Form::model($discussion,['method'=>'PATCH','route'=>['discussions.update',$discussion->id],'files'=>true,]) !!}

            <div class="form-group">
                {!! Form::label('content','Content:') !!}
                {!! Form::textarea('content',$discussion->content,['class'=>'form-control' ,'id'=>'content','rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Discussion',['class'=>'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
