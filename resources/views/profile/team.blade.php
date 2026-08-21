@extends('layouts.app') @section('title','Team') @section('content')
<div class="page-head"><div><p class="eyebrow">ADMIN CONSOLE</p><h1>Workspace members</h1></div></div><section class="panel"><table><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr></thead><tbody>@foreach($users as $user)<tr><td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td></tr>@endforeach</tbody></table></section>
@endsection
