<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyFoodsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2); // 食べた量
            $table->string('meal_time'); // 朝食、昼食、夕食
            $table->decimal('calories', 8, 2)->nullable(); // カロリー
            $table->decimal('carbohydrates', 8, 2)->nullable(); // 炭水化物
            $table->decimal('protein', 8, 2)->nullable(); // タンパク質
            $table->decimal('fat', 8, 2)->nullable(); // 脂質
            $table->decimal('vitamin', 8, 2)->nullable(); // ビタミン
            $table->decimal('mineral', 8, 2)->nullable(); // ミネラル
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_foods');
    }
}
