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

	public function postSaveDream(){
		$id = Input::get('id');
		if($id==0)
			$obj = new HouseDesign();
		else
			$obj = HouseDesign::find($id);

		$obj->properties = json_encode(Input::get('house'));
		$obj->dreamer_id = Auth::user()->id;
		$obj->save();

		return array('success'=>true, 'ID'=>$obj->id);
	}

	public function getMyDreams(){
		return HouseDesign::where('dreamer_id', Auth::user()->id)->get();
	}

}