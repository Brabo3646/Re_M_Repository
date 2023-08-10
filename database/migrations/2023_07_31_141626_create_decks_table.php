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
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->string('deck_name');
            //デッキの名前
            $table->foreignId('creator_id')->constrained('users');
            //作成したユーザーのid
            $table->text('description')->nullable();
            //デッキについての説明
            // $table->tinyInteger('quiztype');
            //クイズのタイプ(時間の関係上、割愛)
            //1で○×クイズ、2で４択クイズ、3で一問一答の予定
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decks');
    }
};
