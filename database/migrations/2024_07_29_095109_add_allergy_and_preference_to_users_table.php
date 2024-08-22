<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllergyAndPreferenceToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'allergy')) {
                $table->string('allergy')->nullable();
            }
            if (!Schema::hasColumn('users', 'preference')) {
                $table->text('preference')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'allergy')) {
                $table->dropColumn('allergy');
            }
            if (Schema::hasColumn('users', 'preference')) {
                $table->dropColumn('preference');
            }
        });
    }
}
