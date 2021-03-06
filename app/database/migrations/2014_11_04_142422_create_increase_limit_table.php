<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncreaseLimitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('increase_limit', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->dateTime('date_increase_limit');
			$table->string('full_name');
			$table->string('id_type');
			$table->string('id_number');
			$table->string('gender');
			$table->string('birth_place');
			$table->date('birth_date');
			$table->string('id_address');
			$table->string('current_address');
			$table->string('message')->nullable();
			$table->string('username_customer')->unique();
			$table->string('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('increase_limit');
	}

}
