<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Products extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	public $timestamps = false;

	protected $guarded = array('id');
	protected $fillable = array('product_name','description','price','merchant_name');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
