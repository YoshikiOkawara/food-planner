<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStocksTable extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // 食材IDカラムを削除
            $table->dropForeign(['ingredient_id']);
            $table->dropColumn('ingredient_id');
            
            // 食材名カラムを追加
            $table->string('ingredient_name');
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            // 食材名カラムを削除
            $table->dropColumn('ingredient_name');
            
            // 食材IDカラムを追加
            $table->unsignedBigInteger('ingredient_id');

            // 外部キー制約を再追加
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }
}
