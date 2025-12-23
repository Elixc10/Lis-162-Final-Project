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
        // First, check if genre_id column exists, if not add it
        if (!Schema::hasColumn('songs', 'genre_id')) {
            Schema::table('songs', function (Blueprint $table) {
                $table->unsignedBigInteger('genre_id')->nullable();
                $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
        });
    }
};
