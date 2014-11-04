<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Topup extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'topup';
	public $timestamps = false;

	protected $guarded = array('id');
	protected $fillable = array('date_topup', 'status', 'amount', 'permata_va_account', 'username_customer');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
