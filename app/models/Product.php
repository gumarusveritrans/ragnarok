<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product';
	public $timestamps = false;
	protected $guarded = array('id');
	protected $fillable = array('product_name','description','price','merchant_name');

	/** 
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function purchase()
    {
        return $this->belongsToMany('Purchase', 'shopping_cart', 'product_id', 'purchase_id')->withPivot('quantity');
    }

}
