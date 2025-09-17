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
        Schema::create('plan_style', function (Blueprint $table) {
            $table->unsignedBigInteger('style_id');
            $table->unsignedBigInteger('plan_id');

            $table->foreign('style_id')->references('id')->on('travel_styles')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('travel_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_style');
    }
};
