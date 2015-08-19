<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flag_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id', false)->nullable();
            $table->unsignedInteger('reply_id', false)->nullable();
            $table->unsignedInteger('user_id', false)->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger('flag_status')->nullable();
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
        Schema::drop('flag_logs');
    }
}
