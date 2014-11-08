<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class IncreaseLimit extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'increase_limit';
	public $timestamps = false;

	protected $guarded = array('id');
	protected $fillable = array('date_increase_limit', 'full_name', 'id_type', 'id_number','gender','birth_place','birth_date','id_address','address','id_image','message', 'username_customer');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

}
