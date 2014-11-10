<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ShoppingCart extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shopping_cart';
	public $timestamps = false;
	protected $guarded = array('id');
	protected $fillable = array('id_transaction', 'quantity', 'id_product');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
