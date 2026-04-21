@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
<form method="POST" action="/login">
    @csrf

    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary btn-block">
        Login
    </button>
</form>
@stop