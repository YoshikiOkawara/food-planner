<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysFromUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 実際には外部キーが存在しないため、ここでは外部キー削除のコードをコメントアウトします。
            // $table->dropForeign('users_foreign_key_column_name_foreign');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 必要であれば外部キーの再追加
            // $table->foreign('foreign_key_column_name')->references('id')->on('foreign_table_name');
        });
    }
}
