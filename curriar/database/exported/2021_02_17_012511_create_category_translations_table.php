<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_translations', function(Blueprint $table)
		{
			$table->bigInteger(''id'', true);
			$table->bigInteger('category_id');
			$table->string('title');
			$table->text('description');
			$table->text('meta_title')->nullable();
			$table->string(''meta_description'', 1000)->nullable();
			$table->string(''keywords'', 1000)->nullable();
			$table->string(''lang'', 100);
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_translations');
	}

}
