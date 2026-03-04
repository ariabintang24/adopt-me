<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // rename column
        Schema::table('animals', function (Blueprint $table) {
            $table->renameColumn('age', 'age_in_months');
        });

        // convert existing data (years -> months)
        DB::table('animals')->update([
            'age_in_months' => DB::raw('age_in_months * 12')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // convert back (months -> years)
        DB::table('animals')->update([
            'age_in_months' => DB::raw('age_in_months / 12')
        ]);

        Schema::table('animals', function (Blueprint $table) {
            $table->renameColumn('age_in_months', 'age');
        });
    }
};
