<?php

class VendorController extends BaseController {
 
 	public function index(){
 		return View::make('dashboard.templates.'.Auth::user()->type.'.vendors');
 	}
}