<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfer', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->dateTime('date_transfer');
			$table->string('from_username');
			$table->string('to_username');
			$table->integer('amount');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transfer');
	}

}
