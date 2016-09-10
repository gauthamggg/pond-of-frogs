
@foreach(session('notifications', []) as $notification)
<div class="alert alert-{{$notification['type']}} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{$notification['message']}}
</div>
@endforeach

