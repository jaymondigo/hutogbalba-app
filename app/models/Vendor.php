<?php 
class Vendor extends User { 

	 
	public function vendorProfile(){
		return $this->hasOne('VendorProfile', 'user_id');
	}

}
