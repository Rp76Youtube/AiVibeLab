@extends('layouts.app') @section('title','Profile') @section('content')
<div class="page-head"><div><p class="eyebrow">ACCOUNT</p><h1>Your profile</h1></div></div><form class="card narrow" method="post" action="{{ route('profile.update') }}">@csrf @method('PATCH')<label>Name<input name="name" value="{{ auth()->user()->name }}"></label><label>Bio<textarea name="bio">{{ auth()->user()->bio }}</textarea></label><p class="meta">Role: <strong>{{ auth()->user()->role }}</strong></p><button>Save changes</button></form>
@endsection
