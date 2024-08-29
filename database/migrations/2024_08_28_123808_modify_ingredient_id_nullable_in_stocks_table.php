<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIngredientIdNullableInStocksTable extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_id')->nullable()->change(); // nullable に変更
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_id')->nullable(false)->change(); // 元に戻す
        });
    }
}
