<?php

class VendorController extends BaseController {
 
 	public function index(){
 		$vendors = VendorProfile::with('vendorOwner')
 						->paginate(15); 
 		return View::make('dashboard.templates.'.Auth::user()->type.'.vendors')
 					->with('vendors',$vendors);
 	}

 	public function create(){
 		return View::make('partials.vendor.new');
 	}

 	public function store(){
 		$obj = new VendorProfile();
		 if(Input::has('id'))
		 	$obj = VendorProfile::find(Input::get('id'));

		 $obj->name = Input::get('name');
		 $obj->address1 = Input::get('address1');
		 $obj->address2 = Input::get('address2');
		 $obj->address3 = Input::get('address3');
		 $obj->email = Input::get('email');
		 $obj->contact = Input::get('contact');
		 $obj->is_verified = Input::get('is_verified');
		 $obj->save();
 
		 return Redirect::back(); 
 	}

 	public function show($id){
 		$vendor = VendorProfile::where('id',$id)->with('vendorOwner')->first();

 		return View::make('partials.vendor.view')
 					->with('vendor', $vendor);
 	}

 	public function edit($id){
 		$vendor = VendorProfile::where('id',$id)->with('vendorOwner')->first();

 		return View::make('partials.vendor.edit')
 					->with('vendor', $vendor);
 	}

	public function getDelete($id=null){
		$vendor = VendorProfile::find($id);
 		if(is_object($vendor))
 			return View::make('partials.vendor.delete')
 						->with('vendor', $vendor);
	}

 	public function postDelete(){
 		$id = Input::get('id');
 		$vendor = VendorProfile::find($id);
 		if(is_object($vendor)){
 				$vendor->delete(); 
 		} 
 		return Redirect::back();
 	}
}