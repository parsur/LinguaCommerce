<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('carts', function(Blueprint $table)
		{
			$table->foreign('course_id', 'course_ibfk_cart')->references('id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'user_ibfk_cart')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carts', function(Blueprint $table)
		{
			$table->dropForeign('course_ibfk_cart');
			$table->dropForeign('user_ibfk_cart');
		});
	}

}
