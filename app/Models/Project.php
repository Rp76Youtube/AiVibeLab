<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model { use HasFactory; protected $fillable=['user_id','name','description','status','budget']; public function owner(){return $this->belongsTo(User::class,'user_id');} public function notes(){return $this->hasMany(Note::class);} public function files(){return $this->hasMany(ProjectFile::class);} }
