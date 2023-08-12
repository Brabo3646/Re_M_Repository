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
            //デッキの説明
            $table->unsignedSmallInteger('question_count')->default(0);
            //入っている問題の数
            $table->unsignedSmallInteger('new_question_number')->default(1);
            //次に作られるクイズのID（問題が入るたびに１増える）
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
