@extends('layouts.app')

@section('title')
Sign In
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Sign In</h1>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('user.signin') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <p>Dont have an account? <a href="{{ route('user.signup') }}">Sign up instead!</a></p>
    </div>
</div>
@endsection

