<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 120);
			$table->timestamps(10);
			$table->integer('article_id')->nullable();
			$table->string('article_type')->nullable();
			$table->integer('category_id')->nullable()->index('category');
			$table->integer('subCategory_id')->nullable()->index('subCategory');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
