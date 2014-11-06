<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Redeem extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'redeem';
	public $timestamps = false;

	protected $guarded = array('id');
	protected $fillable = array('date_redeem','amount','bank_account_name_receiver', 'bank_account_number_receiver', 'bank_name', 'username_customer','redeemed');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
