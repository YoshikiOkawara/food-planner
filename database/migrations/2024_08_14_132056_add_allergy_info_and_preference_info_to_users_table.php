<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllergyInfoAndPreferenceInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('allergy_info')->nullable()->after('email');
            $table->text('preference_info')->nullable()->after('allergy_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['allergy_info', 'preference_info']);
        });
    }
}
