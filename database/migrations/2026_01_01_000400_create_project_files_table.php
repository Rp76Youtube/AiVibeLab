<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void{Schema::create('project_files',function(Blueprint $t){$t->id();$t->foreignId('project_id')->constrained()->cascadeOnDelete();$t->string('original_name');$t->string('path');$t->timestamps();});} public function down():void{Schema::dropIfExists('project_files');} };
