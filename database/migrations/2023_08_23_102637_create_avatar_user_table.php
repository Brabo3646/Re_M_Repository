<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatar_user', function (Blueprint $table) {
            //ユーザーがどのユーザーを（アバターモデルとして）フォローしているかを示す中間テーブル
            $table->unsignedBigInteger('avatar_user_id');
            $table->foreign('avatar_user_id')->references('user_id')->on('avatars')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->primary(['avatar_user_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatar_user');
    }
};
