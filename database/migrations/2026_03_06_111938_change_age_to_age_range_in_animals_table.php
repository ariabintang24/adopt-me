<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            Schema::table('animals', function (Blueprint $table) {
                $table->dropColumn('age_in_months');
            });

            Schema::table('animals', function (Blueprint $table) {
                $table->string('age_range')->after('category_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            Schema::table('animals', function (Blueprint $table) {
                $table->dropColumn('age_range');
            });

            Schema::table('animals', function (Blueprint $table) {
                $table->integer('age_in_months')->after('category_id');
            });
        });
    }
};
