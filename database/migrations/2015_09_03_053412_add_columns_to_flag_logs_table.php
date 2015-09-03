<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToFlagLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flag_logs', function(Blueprint $table) {
            $table->unsignedInteger('quote_id', false)->nullable()->after('reply_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flag_logs', function(Blueprint $table) {
            
        });
    }
}
