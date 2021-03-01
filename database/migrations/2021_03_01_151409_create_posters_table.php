<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posters', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('0 = image
1 = video');
			$table->text('url')->nullable();
			$table->integer('type');
			$table->integer('poster_id');
			$table->string('poster_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posters');
	}

}
