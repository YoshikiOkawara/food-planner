<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('type'); // 食事の種類（朝食、昼食、夕食など）
            $table->json('ingredients'); // 食材情報をJSON形式で保存
            $table->json('nutrition_info'); // 栄養情報をJSON形式で保存
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID、関連するユーザーが削除された場合に食事情報も削除
            $table->timestamps(); // created_at と updated_at タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
