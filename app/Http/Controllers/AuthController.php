<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
 public function showLogin(){return view('auth.login');} public function showRegister(){return view('auth.register');}
 public function login(Request $r){$c=$r->validate(['email'=>['required','email'],'password'=>['required']]);if(Auth::attempt($c)){$r->session()->regenerate();return redirect()->intended(route('dashboard'));}return back()->withErrors(['email'=>'Email or password is incorrect.'])->onlyInput('email');}
 public function register(Request $r){$d=$r->validate(['name'=>['required','max:80'],'email'=>['required','email','unique:users'],'password'=>['required','min:6','confirmed']]);$d['password']=Hash::make($d['password']);$d['role']='member';$u=User::create($d);Auth::login($u);return redirect()->route('dashboard');}
 public function logout(Request $r){Auth::logout();$r->session()->invalidate();return redirect()->route('login');}
}
