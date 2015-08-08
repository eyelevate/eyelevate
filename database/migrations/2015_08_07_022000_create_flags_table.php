<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id', false)->nullable();
            $table->unsignedInteger('reply_id', false)->nullable();
            $table->unsignedInteger('flagger_user_id', false)->nullable();
            $table->unsignedInteger('flagged_user_id', false)->nullable();
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
        Schema::drop('flags');
    }
}
