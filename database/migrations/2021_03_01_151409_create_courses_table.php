<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('0 = Active\n//\n1 = Inactive');
			$table->string('name', 220);
			$table->float('price', 10, 0)->nullable();
			$table->integer('category_id')->nullable()->index('c_id');
			$table->integer('subCategory_id')->nullable()->index('sc_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
