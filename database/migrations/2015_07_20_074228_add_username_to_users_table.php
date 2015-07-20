<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('username')->nullable()->after('id');
            $table->string('firstname', 25)->nullable()->after('username');
            $table->string('lastname', 25)->nullable()->after('firstname');
            $table->tinyInteger('roles');
            $table->softDeletes();

            //DROP
            $table->dropColumn(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            
        });
    }
}
