<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Transaction extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transaction';
	public $timestamps = false;
	protected $guarded = array('id');
	protected $fillable = array('date_transaction', 'username_customer', 'status');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function product()
    {
        return $this->belongsToMany('Product', 'shopping_cart', 'transaction_id', 'product_id')->withPivot('quantity');
    }

}
