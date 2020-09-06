<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('user who liked this');
            $table->unsignedBigInteger('liked_user_id')->comment('user whom this liked');
            $table->unsignedBigInteger('send_user_id')->comment('send_user');
            $table->boolean('is_mutual')->default(false)->comment('is users like each other');
            $table->boolean('unlike')->default(false)->comment('unlike');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('liked_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_likes');
    }
}
