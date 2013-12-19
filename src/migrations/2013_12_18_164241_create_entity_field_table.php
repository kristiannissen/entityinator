<?php

use Illuminate\Database\Migrations\Migration;

class CreateEntityFieldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the Entity Field Pivot table
		Schema::create('entity_field', function ($table) {
			$table->increments('id');
			$table->integer('entity_id');
			$table->integer('field_id');
			$table->text('entity_field_value')->nullable();
			$table->integer('sort_order')->nullable()->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop the Entity Field table
		Schema::drop('entity_field');
	}

}