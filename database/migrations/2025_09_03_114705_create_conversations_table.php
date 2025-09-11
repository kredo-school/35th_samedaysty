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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user1_id');
            $table->unsignedBigInteger('user2_id');
            $table->text('last_message')->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            // ユーザーIDの外部キー制約
            $table->foreign('user1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user2_id')->references('id')->on('users')->onDelete('cascade');

            // 同じユーザー間での重複会話を防ぐ
            $table->unique(['user1_id', 'user2_id']);

            // インデックス
            $table->index(['user1_id', 'last_message_at']);
            $table->index(['user2_id', 'last_message_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
