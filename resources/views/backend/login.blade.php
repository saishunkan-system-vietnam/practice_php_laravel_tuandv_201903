@extends('backend.layout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/login.css') }}">
@stop
@section('javascript')

@stop
@section('content')
    <div class="FormLogin">
        <form action="{{url('admin/login')}}" method="POST" role="form">
            <legend>Login</legend>
           {{-- @if($errors->has('errorlogin'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif--}}
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <p class="err">
                {{ (isset($errors) && $errors == "fail")?'Username or Password incorrect':'' }}
            </p>
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
@stop