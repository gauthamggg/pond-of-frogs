@extends('layout')

@section('content')
<p>
    <a href="{{route('frog.create')}}" class="btn btn-primary">Add frog to the pond</a>
</p>
<div class="panel panel-default">
    <div class="panel-heading">Your frogs in the pond</div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Born on</th>
                <th>Is dead?</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($frogs as $frog)
            <tr>
                <th scope="row">{{$frog->id}}</th>
                <td>{{$frog->name}}</td>
                <td>{{$frog->gender}}</td>
                <td>{{$frog->created_at}}</td>
                <td>{{$frog->is_dead ? 'Yes':'No'}}</td>
                <td>
                    <a href="{{route('frog.edit',['id' => $frog->id])}}" class="btn btn-warning">Edit</a>
					
                   
                </td>
            </tr>
            @empty
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Oh Sad! Your pond doesn't have any frogs. It will be fun if you create one or two?
            </div>
            @endforelse
            </tbody>
        </table>
        {!! $frogs->render() !!}
    </div>
</div>
@stop