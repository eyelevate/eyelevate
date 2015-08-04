<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('<span id="IL_AD1" class="IL_AD">permissions</span>', function(Blueprint $table) {
            Schema::drop('<span id="IL_AD1" class="IL_AD">permissions</span>');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('<span id="IL_AD1" class="IL_AD">permissions</span>', function(Blueprint $table) {
            
        });
    }
}
