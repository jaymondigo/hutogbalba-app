<?php

class DreamerController extends BaseController {
	
	public function getIndex(){
		return Redirect::to('dreamer/dreams');
	}	 

	public function getDreams(){
		return View::make('dashboard.templates.dreamer.dreams');
	}

	public function getPreview3d($id){
		$id = isset($id) ? $id : Input::get('id');
		$houseDesign = HouseDesign::find($id);

		if(!is_object($houseDesign))
			return array('House design not found!');
		 
		return View::make('dashboard.templates.'.Auth::user()->type.'.3d')
					->with('houseDesign', $houseDesign);
	}

}