<?php 

use LaravelBook\Ardent\Ardent; 
class VendorProfile extends Ardent { 
 	public function vendorOwner(){
 		return $this->belongsTo('User','vendor_id');
 	}
}
