<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingsColumnsToRecipesTable extends Migration
{
    /**
     * Apply the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->integer('rating_total')->default(0);
            $table->integer('rating_count')->default(0);
            $table->float('rating', 2, 1)->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('rating_total');
            $table->dropColumn('rating_count');
            $table->dropColumn('rating');
        });
    }
}
