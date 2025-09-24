<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'declined'])
                  ->default('pending')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                  ->default('pending')
                  ->change();
        });
    }
};
