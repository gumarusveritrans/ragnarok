<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topup', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->dateTime('date_topup');
			$table->string('status');
			$table->integer('amount');
			$table->string('permata_va_account');
			$table->string('username_customer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('topup');
	}

}
