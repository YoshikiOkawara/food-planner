<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('recipes')) {
            Schema::create('recipes', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // 料理のタイトル
                $table->text('description'); // 作り方
                $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 外部キーのuser_id
                $table->timestamps(); // created_atとupdated_at
                $table->softDeletes(); // deleted_at
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
