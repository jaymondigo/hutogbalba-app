<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPictureFieldsToHousePicturesTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('house_pictures', function(Blueprint $table) {		
			
			$table->string("picture_file_name")->nullable();
			$table->integer("picture_file_size")->nullable();
			$table->string("picture_content_type")->nullable();
			$table->timestamp("picture_updated_at")->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('house_pictures', function(Blueprint $table) {

			$table->dropColumn("picture_file_name");
			$table->dropColumn("picture_file_size");
			$table->dropColumn("picture_content_type");
			$table->dropColumn("picture_updated_at");

		});
	}

}