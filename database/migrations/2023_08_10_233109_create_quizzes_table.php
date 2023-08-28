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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deck_id')->constrained('decks')->onDelete('cascade');
            //紐づくデッキのID（多対一の関係）
            $table->unsignedSmallInteger('question_number');
            //所属するデッキ内でのID（基本的に作られた順）
            $table->string('question');
            //クイズの問い
            $table->string('answer');
            //クイズの答え
            $table->boolean('hidden')->default(false);
            //trueになると、問題が登場しなくなる
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
        Schema::dropIfExists('quizzes');
    }
};
