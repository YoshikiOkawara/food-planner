<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('name'); // 食事プランの名前
            $table->text('description')->nullable(); // 食事プランの説明
            $table->date('start_date'); // プランの開始日
            $table->date('end_date'); // プランの終了日
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID、関連するユーザーが削除された場合にプラン情報も削除
            $table->json('meals'); // プランに含まれる食事をJSON形式で保存
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
        Schema::dropIfExists('meal_plans');
    }
}
