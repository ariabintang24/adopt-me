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
        Schema::table('adopt_requests', function (Blueprint $table) {
            // 1️⃣ Drop foreign keys dulu
            $table->dropForeign(['user_id']);
            $table->dropForeign(['animal_id']);

            // 2️⃣ Drop unique constraint
            $table->dropUnique(['user_id', 'animal_id']);

            // 3️⃣ Tambahkan index biasa (agar FK tetap punya index)
            $table->index(['user_id']);
            $table->index(['animal_id']);

            // 4️⃣ Tambahkan kembali foreign keys
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('animal_id')->references('id')->on('animals')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adopt_requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['animal_id']);

            $table->dropIndex(['user_id']);
            $table->dropIndex(['animal_id']);

            $table->unique(['user_id', 'animal_id']);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('animal_id')->references('id')->on('animals')->cascadeOnDelete();
        });
    }
};
