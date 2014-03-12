<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVendorProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendor_profiles', function($table){
			$table->increments('id');
			$table->integer('vendor_id');
			$table->string('name');
			$table->boolean('is_verified');
			$table->string('contact'); 
			$table->string('email');
			$table->string('address1');
			$table->string('address2');
			$table->string('address3');
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
		Schema::dropIfExists('vendor_profiles');
	}

}
