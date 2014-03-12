<?php
use LaravelBook\Ardent\Ardent; 
class Element extends Ardent { 

	public function types(){
		return $this->hasMany('Type', 'element');
	}
}