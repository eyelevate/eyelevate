<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replies', function(Blueprint $table) {
            $table->unsignedInteger('thread_id', false)->nullable();
            $table->unsignedInteger('user_id', false)->nullable();
            $table->unsignedInteger('quote_id', false)->nullable();
            $table->bigInteger('eye_likes');
            $table->bigInteger('dont_likes');
            // $table->tinyInteger('flag');
            $table->text('reply')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replies', function(Blueprint $table) {
            
        });
    }
}
