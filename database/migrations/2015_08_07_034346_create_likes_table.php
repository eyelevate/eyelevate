<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id', false)->nullable();
            $table->unsignedInteger('reply_id', false)->nullable();
            $table->unsignedInteger('liker_user_id', false)->nullable();
            $table->unsignedInteger('liked_user_id', false)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->softDeletes();
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
        Schema::drop('likes');
    }
}
