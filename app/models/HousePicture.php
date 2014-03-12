<?php
use LaravelBook\Ardent\Ardent; 
class HousePicture extends Ardent { 
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
 
 	public function house(){
 		return $this->belongsTo('HouseDesign', 'house_id');
 	}
}
