<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysFromIngredientUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_user', function (Blueprint $table) {
            // 外部キー制約の削除を試みる
            if (Schema::hasColumn('ingredient_user', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            if (Schema::hasColumn('ingredient_user', 'ingredient_id')) {
                $table->dropForeign(['ingredient_id']);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_user', function (Blueprint $table) {
            // 外部キー制約を再作成
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }
}
