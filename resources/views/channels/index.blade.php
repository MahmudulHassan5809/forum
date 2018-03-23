@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Chanels</div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                           @if(count($channels) > 0)
                            @foreach($channels as $channel)
                                <tr>

                                <td>{{$channel->title}}</td>
                                <td><a href="{{route('channels.edit',['channel'=>$channel->id])}}" class="btn btn-success btn-xs">Edit</a></td>
                                <td>
                                    {!! Form::open(['route' => ['channels.destroy','channel'=>$channel->id],'method'=>'POST']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete',['class' => 'btn btn-danger btn-sm'])}}
                                    {!! Form::close() !!}
                                </td>
                              </tr>
                            @endforeach
                               @else
                                <tr>
                                    <td colspan="3">
                                        No Data Available
                                    </td>
                                </tr>

                            @endif
                            </tbody>
                          </table>
                    </div>
                </div>



@endsection
