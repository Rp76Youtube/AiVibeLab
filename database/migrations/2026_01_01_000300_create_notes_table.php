<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void{Schema::create('notes',function(Blueprint $t){$t->id();$t->foreignId('project_id')->constrained()->cascadeOnDelete();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->text('body');$t->timestamps();});} public function down():void{Schema::dropIfExists('notes');} };
