<?php

class UserController extends BaseController {

	public function getLogin()
	{	
		if(Auth::user())
			return Redirect::to('home');

		return View::make('public.login');
	}

	public function getRegister(){
		if(Auth::user())
			return Redirect::to('home');

		return View::make('public.register');
	}

}