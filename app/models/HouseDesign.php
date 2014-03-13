<?php
use LaravelBook\Ardent\Ardent; 
class HouseDesign extends Ardent { 

	 public static $rules = array( 
        'name' => 'required|unique:house_designs'
    );

	public function pictures(){
		return $this->hasMany('HousePicture', 'house_id');
	}

	public function afterCreate() {
		$properties = json_decode($this->properties);
		$roof = DbsHelper::cm2ft($properties->width) * DbsHelper::cm2ft($properties->length * 1.5);
		$wall = (DbsHelper::cm2ft($properties->width) * DbsHelper::cm2ft($properties->height) * 2) + (DbsHelper::cm2ft($properties->length * DbsHelper::cm2ft($properties->height) * 2);
		$floor = DbsHelper::cm2ft($properties->width) * DbsHelper::cm2ft($properties->length) * DbsHelper::cm2ft($properties->terrain);
		$rooms = 0;
		foreach($properties->rooms as $room) {
			if(is_object($room))
				$rooms += ($room->width * $room->height * 2) + ($room->length * $room->height * 2);
		}
		$windows = 0;
		foreach($properties->windows as $window) {
			if(is_object($window))
				$windows += $window->width * $window->length;
		}
		$rooms = 0;
		foreach($properties->rooms as $room) {
			if(is_object($room))
				$rooms += (DbsHelper::cm2ft($room->width) * DbsHelper::cm2ft($properties->height) * 2) + (DbsHelper::cm2ft($room->length * DbsHelper::cm2ft($properties->height) * 2);
		}
		$hb = DbsHelper::getHollowBlocks($rooms);
		$doors = array();
		foreach($properties->doors as $door) {
			if(isset($doors[$door->type])
				$doors[$door->type]++;
			else
				$doors[$door->type] = 1;
		}
		$materials = array(
			$properties->roof->element => DbsHelper::getShingles($roof),
			'sand' => DbsHelper::getSandGravel($floor),$properties->floor->type => $properties->floor->type == 'ceramic_tile' ? DbsHelper::getTiles($floor, 9) : $floor,
			'jalousie' => DbsHelper::getJalousie($windows),
			'hollow_blocks' => $hb,
			'cement' => DbsHelper::getMortar($hb)
			);
		if($properties->wall->element == 'plywood') {
			$materials['plywood'] = DbsHelper::getPlywoodSheets($wall);
		}
		else {
			$bricks = DbsHelper::getBricks($wall);
			$materials[$properties->wall->element] = $bricks;
			$materials['cement'] += DbsHelper::getMortar($bricks);
		}
		foreach($doors as $key => $value)
			$materials[$key] = $value;
	}
}
