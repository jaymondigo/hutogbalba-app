<?php
use LaravelBook\Ardent\Ardent; 
class Material extends Ardent { 

	protected $fillable = array('productID', 'name', 'price','type', 'availability', 'vendor');
	public function productType(){
		return $this->belongsTo('Type', 'type');
	}

	public function userVendor(){
		return $this->belongsTo('User', 'vendor');
	}

}
