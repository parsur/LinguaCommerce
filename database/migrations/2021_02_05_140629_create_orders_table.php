<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->string('order_factor', 35);
			$table->string('totalـprice', 55)->nullable();
			$table->string('transportation', 55);
			$table->string('payment', 55);
			$table->integer('status')->nullable()->default(0)->comment('0 = User will not be redirected to the Idpay / 1 = User will be redirected to the Idpay');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
