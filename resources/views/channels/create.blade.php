@extends('layouts.app')

@section('content')




                <div class="panel panel-default">
                    <div class="panel-heading">Create A new Channel</div>

                    {{--form open--}}
                    <div class="col-md-6">
                        {!! Form::open(['method'=>'POST','route'=>'channels.store','files'=>true]) !!}


                        <div class="form-group">
                        {!! Form::label('title','Name:') !!}
                        {!! Form::text('title',null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create Chanel',['class'=>'btn btn-info']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                    {{--form close--}}
                </div>
              <



@endsection
