<?php

class ProductController extends BaseController {


	public function index(){
		$obj = Product::all();
		
		return View::make('dashboard.templates.'.Auth::user()->type.'.products')		->with('products', $obj);
	}

	public function store(){
		if(Input::has('id')){
			$obj = Product::find(Input::get('id'));
			if(Input::has('method') && Input::get('method') == 'delete')
			{
				$obj->delete();
				return 1;
			}
		}
		else
			$obj = new Product();


		$obj->product_id	=	Input::get('product_id');
		$obj->vendor_id 	=	Input::get('vendor_id');
		$obj->name 			=	Input::get('name');
		$obj->description 	=	Input::get('description');
		$obj->price 		=	Input::get('price');
		$obj->material_type_id =Input::get('material_type_id');
		$obj->save();


	}

	public function show($id){
		$obj = Product::find($id);
		return $obj;
	}

	public function edit($id){
		$obj = Product::find($id);
	}
 
}