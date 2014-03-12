<?php
use LaravelBook\Ardent\Ardent; 
class HouseDesign extends Ardent { 

	 public static $rules = array( 
        'name' => 'required|unique:house_designs'
    );
}