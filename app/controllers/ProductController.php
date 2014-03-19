<?php

class ProductController extends BaseController {


	public function index(){
		$obj = Material::with(array('vendorProfile','productType'))->paginate(15);; 
		
		return View::make('dashboard.templates.'.Auth::user()->type.'.products')->with('products', $obj);
	}

	public function create(){ 
		 $vendors = VendorProfile::where('is_verified',1)->get();
		 $elements = Element::with('Types')->get();
		 
		 return View::make('partials.product.new')
		 			->with('vendors', $vendors)
		 			->with('elements', $elements);
	}

	public function store(){ 
		 $obj = new Material();
		 if(Input::has('id'))
		 	$obj = Material::find(Input::get('id'));
		 $obj->productID = Input::get('productID');
		 $obj->name = Input::get('name');
		 $obj->type = Input::get('type');
		 $obj->availability = Input::get('availability');
		 $obj->price = Input::get('price');
		 $obj->vendor = Input::get('vendor'); 
		 $obj->picture = Input::file('picture');
		 $obj->save();
		 Session::flash('success', 'Product Successfully added');
		 return Redirect::back();
	}

	public function show($id){ 
		$obj = Material::with(array('vendorProfile','productType'))->where('id',$id)->first(); 
		if(is_object($obj))
			return View::make('partials.product.view')
					->with('product', $obj);
		else
			return array('no Material found');
	}

	public function edit($id){
		$obj = Material::with(array('vendorProfile','productType'))->where('id',$id)->first(); 
		// return $obj;
		$vendors = VendorProfile::where('is_verified',1)->get();
		 $elements = Element::with('Types')->get(); 
		 return View::make('partials.product.edit')
		 			->with('product',$obj)
		 			->with('vendors', $vendors)
		 			->with('elements', $elements);
	}

	public function getDelete($id=null){
		if($id && $obj = Material::find($id)){
			return View::make('partials.product.delete')
						->with('product', $obj);
		}
	}
	public function postDelete($id=null){
		if($id || $id= Input::get('id'))
		{	
			$obj = Material::find($id);
			if(is_object($obj))
				$obj->delete();
		}

		return Redirect::back();
	}

	public function getSelect($t){
		$index = Input::get('i'); 
		$type = str_replace('_', ' ', $t); 

		$obj = Material::join('types','types.id', '=','materials.type')
						->where('types.name', 'LIKE', $type.'%')
						->get(array('materials.*', 'types.name AS type')); 
         
		return View::make('partials.product.options')
					->with('products', $obj)
					->with('type', $t)
					->with('i', $index);	
	}
 
}