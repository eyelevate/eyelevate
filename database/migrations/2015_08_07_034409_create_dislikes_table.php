<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDislikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dislikes', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id', false)->nullable();
            $table->unsignedInteger('reply_id', false)->nullable();
            $table->unsignedInteger('disliker_user_id', false)->nullable();
            $table->unsignedInteger('disliked_user_id', false)->nullable();
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
        Schema::drop('dislikes');
    }
}
