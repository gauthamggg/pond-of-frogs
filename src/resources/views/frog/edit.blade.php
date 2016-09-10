@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Updating a Frog</h1>
        <form action="{{route('frog.update', ['id' => $frog->id])}}" method="POST"> 
         <div class="form-group">
                <label for="frog-name">Name</label>
                <input type="text" class="form-control" id="frog-name" placeholder="Enter frog name" name="name" value="{{$frog->name}}">
               
            </div>
            <div class="form-group">
                <label for="frog-gender">Gender</label>
                <select class="form-control" id="frog-gender" name="gender">
                    <option value="M" >Male</option>
                    <option value="F" >Female</option>
                </select>
                <span class="help-block"><p class="text-danger">{{(isset($errors)) ? $errors->first('gender') : ''}}</p></span>
            </div>
            <button type="submit" class="btn btn-success">Update this frog</button>
        </form>
    </div>
</div>
@stop