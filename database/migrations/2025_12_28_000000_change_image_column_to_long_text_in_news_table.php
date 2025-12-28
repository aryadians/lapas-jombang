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
        Schema::table('news', function (Blueprint $table) {
            // Change the 'image' column to longText.
            // If it already exists, use change() method.
            // Make sure to add doctrine/dbal composer package if you haven't already.
            $table->longText('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Revert the 'image' column back to string if needed on rollback
            $table->string('image')->nullable()->change();
        });
    }
};
