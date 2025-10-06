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
        Schema::table('gadgets', function (Blueprint $table) {
            $table->longText('photo_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gadgets', function (Blueprint $table) {
            $table->string('photo_url', 255)->nullable()->change();
        });
    }
};
