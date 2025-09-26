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
        // Update comments table foreign key constraints
        Schema::table('comments', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['plan_id']);

            // Recreate with cascade delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('travel_plans')->onDelete('cascade');
        });

        // Update participant_chats table foreign key constraints
        Schema::table('participant_chats', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['plan_id']);

            // Recreate with cascade delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('travel_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert comments table foreign key constraints
        Schema::table('comments', function (Blueprint $table) {
            // Drop cascade foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['plan_id']);

            // Recreate without cascade delete
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('travel_plans');
        });

        // Revert participant_chats table foreign key constraints
        Schema::table('participant_chats', function (Blueprint $table) {
            // Drop cascade foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['plan_id']);

            // Recreate without cascade delete
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('travel_plans');
        });
    }
};