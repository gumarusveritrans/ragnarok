<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Purchase extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'purchase';
	public $timestamps = false;
	protected $guarded = array('id');
	protected $fillable = array('date_purchase', 'username_customer', 'status');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function product()
    {
        return $this->belongsToMany('Product', 'shopping_cart', 'purchase_id', 'product_id')->withPivot('quantity');
    }

    public function total(){
    	$sum = 0;
    	$products = $this->product()->get();
    	foreach($products as $product){
    		$sum += $product->pivot->quantity * $product->price;
    	}
    	return $sum;
    }

}
