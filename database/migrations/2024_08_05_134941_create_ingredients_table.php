<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('calorie')->nullable();
            $table->integer('carbohydrate')->nullable();
            $table->integer('protein')->nullable(); 
            $table->integer('fat')->nullable();
            $table->integer('vitamin')->nullable();
            $table->integer('mineral')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
