<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->tinyInteger('invoice_type')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->decimal('subtotal', 11,2)->nullable();
            $table->decimal('tax',11,2)->nullable();
            $table->decimal('total',11,2)->nullable();
            $table->dateTime('sent')->nullable();
            $table->dateTime('due')->nullable();
            $table->dateTime('paid')->nullable();
            $table->tinyInteger('paid_type')->nullable();
     		$table->tinyInteger('status')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('invoices');
    }
}