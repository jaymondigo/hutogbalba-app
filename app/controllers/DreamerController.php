<?php

class DreamerController extends BaseController {
	
	public function getIndex(){
		return Redirect::to('dreamer/dreams');
	}	 

	public function getDreams(){
		
		return View::make('dashboard.templates.dreamer.dreams');
	}

	public function getDreamHouse($id){
		return HouseDesign::find($id);
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
		$obj = HouseDesign::find($id);
		if(!is_object($obj))
			$obj = new HouseDesign();
		 
		$obj->properties = json_encode(Input::get('house'));
		$obj->dreamer_id = Auth::user()->id;
		$obj->name = Input::get('name');

		if(!is_object($obj))
			$obj->save();
		else
			$obj->updateUniques();
		
		if(count($obj->validationErrors)<=0)
			return array('success'=>true, 'ID'=>$obj->id, 'name'=>$obj->name);
		else{	
			$errors = '';
			foreach(json_decode($obj->validationErrors, true) as $i => $data){
				$errors .= $data[0]."<br/>";
			}
			return array('success'=>false, 'errors'=>$errors);
		}
	}

	public function getMyDreams(){
		return HouseDesign::where('dreamer_id', Auth::user()->id)->get();
	}

	public function postUploadScreenshot(){
		$obj = HouseDesign::find(Input::get('id'));
		if(!is_object($obj))
			return array('success'=>false, 'message'=>'No house design found');
 
		$objPic = new HousePicture();
		$objPic->picture = Input::file('picture');
		$objPic->house_id = $obj->id;
		$objPic->save();

		return array('success'=>true, 'message'=>'House design successfully saved');
	}

	public function postDeleteDream(){
		$id = Input::get('id');
		HouseDesign::find($id)->delete();
		HousePicture::where('house_id', $id)->delete();

		Session::flash('success',true);
		Session::flash('message','House Design deleted successfully'); 
	}

	public function getPreviewDream($id){
		$obj = HouseDesign::with('pictures')->where('id', $id)->first();
		return View::make('partials.dream_house.view')
					->with('dream', $obj);
	}
	public function getEstimate($id){
		$obj = HouseDesign::find($id);
		return View::make('partials.estimate.view')
					->with('dream', $obj);
	}

	public function getOptions(){
		return View::make('partials.options.view');
	}
}