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
        Schema::create('avatar_deck', function (Blueprint $table) {
            //ユーザーがどのデッキをアバターとして共有したかを示す中間テーブル
            
            $table->unsignedBigInteger('avatar_user_id');
            $table->foreign('avatar_user_id')->references('user_id')->on('avatars')->onDelete('cascade');
            $table->unsignedBigInteger('deck_id');
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->primary(['avatar_user_id','deck_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatar_deck');
    }
};
