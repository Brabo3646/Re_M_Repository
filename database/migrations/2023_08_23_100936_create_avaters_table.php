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
        Schema::create('avaters', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('avater_name');
            // ユーザーの公開名
            $table->string('avater_ID')->unique();
            // ユーザーが設定できるID（ほかの人から検索するときに利用する）
            $table->string('introduce')->nullable();
            // 自己紹介文
            $table->boolean('searchable');
            // falseの時、検索に引っかからない
            $table->timestamps();
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avater');
    }
};
