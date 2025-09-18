<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*** Run the migrations. */
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id'); //user who click "follow"
            $table->unsignedBigInteger('following_id'); //user with follower button
            $table->timestamps();

            $table->unique(['follower_id', 'following_id']);
            //foreign key
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /*** Reverse the migrations.*/
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
