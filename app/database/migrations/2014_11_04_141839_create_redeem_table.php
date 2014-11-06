<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('redeem', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->dateTime('date_redeem');
			$table->integer('amount');
			$table->string('bank_account_name_receiver');
			$table->string('bank_account_number_receiver');
			$table->string('bank_name');
			$table->string('username_customer');
			$table->boolean('redeemed');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('redeem');
	}
}
