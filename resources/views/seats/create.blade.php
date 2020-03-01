// Example of Create Post Form on Modal Layout in
// resources/views/posts/create.blade.php
// 'layout.errors' simple template to show validation errors.
@extends('components.modal')
@section('title') Demo Modal @endsection
@section('content')
<form action="/store" method="POST" data-remote="true">
     @csrf
     <input type="email" name="email" class="form-control">
     <input type="name" name="name" class="form-control">
     <button type="submit" class="btn btn-primary">Close</button>
</form>
@endsection
@section('footer')
    <button type="button" data-dismiss="modal">Close</button>
@endsection