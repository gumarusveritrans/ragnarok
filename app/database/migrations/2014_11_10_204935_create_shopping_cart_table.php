<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopping_cart', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('quantity');
			$table->bigInteger('purchase_id');
			$table->bigInteger('product_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shopping_cart');
	}

}