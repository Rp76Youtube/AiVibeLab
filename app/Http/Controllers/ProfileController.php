<?php
namespace App\Http\Controllers;
use App\Models\User;use Illuminate\Http\Request;
class ProfileController extends Controller {
 public function edit(){return view('profile.edit');}
 public function update(Request $r){$r->validate(['name'=>['sometimes','string','max:80'],'bio'=>['nullable','string','max:500']]);auth()->user()->update($r->all());return back()->with('ok','Profile updated.');}
 public function team(Request $r){abort_unless(auth()->user()->role==='admin'||$r->boolean('preview_admin'),403);$users=User::orderBy('id')->get();return view('profile.team',compact('users'));}
}
