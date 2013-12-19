<?php

use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Entities table
    Schema::create('entities', function ($table) {
      $table->increments('id');
      $table->timestamps();
      $table->string('name');
			$table->integer('parent_id')->nullable()->default(0);
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop Entities table
    Schema::drop('entities');
	}

}
