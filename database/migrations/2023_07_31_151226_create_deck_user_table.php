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
            $table->foreignId('deck_id')->constrained('decks');
            $table->foreignId('user_id')->constrained('users');
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
