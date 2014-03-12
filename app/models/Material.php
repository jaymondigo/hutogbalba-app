<?php
use LaravelBook\Ardent\Ardent; 
class Material extends Ardent { 
	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('picture', [
          'styles' => [
            'medium' => '300x300',
            'thumb' => '100x100'
          ],
          'default_url' => 'missing-material.jpg'
      ]);

      parent::__construct($attributes);
  	}

	protected $fillable = array('productID', 'name', 'price','type', 'availability', 'vendor');
	public function productType(){
		return $this->belongsTo('Type', 'type');
	}

	// public function userVendor(){
	// 	return $this->belongsTo('User', 'vendor');
	// }

	public function vendorProfile(){
		return $this->belongsTo('VendorProfile','vendor');
	}

}
