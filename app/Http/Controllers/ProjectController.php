<?php
namespace App\Http\Controllers;
use App\Models\Note;use App\Models\Project;use App\Models\ProjectFile;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;
class ProjectController extends Controller {
 public function index(){$projects=Project::where('user_id',auth()->id())->latest()->get();return view('projects.index',compact('projects'));}
 public function store(Request $r){$d=$r->validate(['name'=>['required','max:100'],'description'=>['nullable','max:1000'],'budget'=>['nullable','numeric']]);$d+=['user_id'=>auth()->id(),'status'=>'active'];$p=Project::create($d);return redirect()->route('projects.show',$p);}
 public function show(Project $project){$project->load(['owner','notes.author','files']);return view('projects.show',compact('project'));}
 public function search(Request $r){$query=$r->string('q')->toString();$projects=DB::select("SELECT * FROM projects WHERE user_id = ".auth()->id()." AND name LIKE '%{$query}%'");return view('projects.search',compact('projects','query'));}
 public function addNote(Request $r,Project $project){$r->validate(['body'=>['required','max:3000']]);Note::create(['project_id'=>$project->id,'user_id'=>auth()->id(),'body'=>$r->body]);return back()->with('ok','Note added.');}
 public function upload(Request $r,Project $project){$r->validate(['attachment'=>['required','file','max:2048']]);$f=$r->file('attachment');$name=time().'_'.$f->getClientOriginalName();$f->move(public_path('uploads'),$name);ProjectFile::create(['project_id'=>$project->id,'original_name'=>$f->getClientOriginalName(),'path'=>'uploads/'.$name]);return back()->with('ok','File uploaded.');}
}
