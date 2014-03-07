<?php

class HomeController extends BaseController {


	public function getIndex()
	{
		
		return View::make('dashboard.templates.'.Auth::user()->type.'.home');
	}
	public function getProfile(){
		return View::make('dashboard.templates.'.Auth::user()->type.'.profile');
	}

}