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
        Schema::create('travel_plans', function (Blueprint $table) {
            $table->id(); // id (主キー)

            $table->unsignedBigInteger('user_id');      // ユーザーID（外部キー）
            $table->string('title');                    // タイトル
            $table->unsignedBigInteger('country_id');   // カントリーID（外部キー予定）
            $table->date('start_date');                 // 開始日
            $table->date('end_date');                   // 終了日
            $table->text('description')->nullable();    // 詳細説明
            $table->integer('max_participants')->nullable(); // 最大参加人数

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_plans');
    }
};
