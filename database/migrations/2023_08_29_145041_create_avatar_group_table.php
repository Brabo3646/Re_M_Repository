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
        Schema::create('avatar_group', function (Blueprint $table) {
            $table->unsignedBigInteger('avatar_user_id');
            $table->foreign('avatar_user_id')->references('user_id')->on('avatars')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->boolean('admin')->default(false);
            // 管理者権限を持っているかどうか
            $table->unsignedBigInteger('invite_user_id')->default(0);
            // 招待したアバターのidを入力、０以外の時、加盟の許可、拒否を選択できる。
            // 加盟の承諾をすると０が入力される
            $table->primary(['avatar_user_id','group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatar_group');
    }
};
