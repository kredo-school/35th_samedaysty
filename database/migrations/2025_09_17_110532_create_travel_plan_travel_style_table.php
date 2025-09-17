<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_plan_travel_style', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('travel_style_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_plan_travel_style');
    }
};
