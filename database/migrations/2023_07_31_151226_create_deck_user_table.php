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
        Schema::create('deck_user', function (Blueprint $table) {
            //ユーザーがどのデッキを「所有」しているかを示す中間テーブル
            //(誰が作成したかは問わない)
            $table->unsignedBigInteger('deck_id');
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('crew_offer')->default(false);
            // 他人から送られてきた時にtrueとなり、リクエストの受け入れ、拒否を選択できる
            $table->primary(['deck_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck_user');
    }
};
