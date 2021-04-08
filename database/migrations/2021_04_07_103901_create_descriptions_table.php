<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descriptions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('description');
			$table->string('description_type');
			$table->integer('description_id');
			$table->index(['description_type','description_id'], 'description_description_type_description_id_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('descriptions');
	}

}
