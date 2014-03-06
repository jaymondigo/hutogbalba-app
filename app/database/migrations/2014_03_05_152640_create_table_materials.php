<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaterials extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function($table){
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('vendor_id');
			$table->string('name');
			$table->integer('num_stocks');
			$table->double('price');
			$table->integer('material_type_id');
			$table->integer('material_property_id');
			$table->text('description');
			$table->softDeletes();
			$table->timeStamps(); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('materials');
	}

}
