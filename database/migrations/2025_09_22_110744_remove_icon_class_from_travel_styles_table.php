<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('travel_styles', function (Blueprint $table) {
            $table->dropColumn('icon_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_styles', function (Blueprint $table) {
            $table->string('icon_class')->nullable();
        });
    }
};
