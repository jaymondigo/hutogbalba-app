<?php

class HomeController extends BaseController {


	public function getIndex()
	{
		$obj = HouseDesign::with('pictures')
							->where('dreamer_id', Auth::user()->id)
							->get();

		return View::make('dashboard.templates.'.Auth::user()->type.'.home')
					->with('dreams', $obj);
	}
	public function getProfile(){
		$user = Auth::user();
		return View::make('dashboard.templates.'.Auth::user()->type.'.profile')
					->with('myAccount', $user);
	}

}