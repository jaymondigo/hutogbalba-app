<?php
use LaravelBook\Ardent\Ardent; 
class Type extends Ardent { 

	public function materials(){
		return $this->hasMany('Material');
	}

	public function element(){
		return $this->belongsTo('Element', 'element');
	}
}