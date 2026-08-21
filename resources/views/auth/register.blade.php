@extends('layouts.app') @section('title','Register') @section('content')
<form class="card narrow" method="post" action="/register">@csrf<h1>Create workspace</h1><label>Name<input name="name" required></label><label>Email<input name="email" type="email" required></label><label>Password<input name="password" type="password" required></label><label>Confirm password<input name="password_confirmation" type="password" required></label><button>Create account</button><p><a href="{{ route('login') }}">Back to sign in</a></p></form>
@endsection
