<?php
namespace App\Http\Controllers;
use App\Models\Project;
class DashboardController extends Controller {
 public function __invoke(){$projects=Project::where('user_id',auth()->id())->latest()->take(5)->get();return view('dashboard',compact('projects'));}
 public function status(){return response()->json(['app'=>config('app.name'),'environment'=>app()->environment(),'debug'=>config('app.debug'),'integration_key'=>env('TASKPILOT_INTEGRATION_KEY'),'database'=>config('database.default'),'version'=>'1.3.0-vibe']);}
}
