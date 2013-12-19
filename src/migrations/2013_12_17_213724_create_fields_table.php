<?php

use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Fields table
		Schema::create('fields', function ($table) {
			$table->increments('id');
			// Fields do not have timestamps
			$table->string('name');
			$table->string('field_type')->nullable()->default('string');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop Fields table
		Schema::drop('fields');
	}

}