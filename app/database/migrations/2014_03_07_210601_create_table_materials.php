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
			$table->string('productID');
			$table->integer('type');
			$table->string('name');
			$table->string('price');
			$table->integer('vendor');
			$table->enum('availability', array('available', 'Few Stocks Left', 'Out of stacks'));
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
		//
	}

}
