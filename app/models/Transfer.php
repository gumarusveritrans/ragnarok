<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Transfer extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transfer';
	public $timestamps = false;
	
	protected $guarded = array('id');
	protected $fillable = array('date_transfer', 'from_username', 'to_username', 'amount');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	

}
