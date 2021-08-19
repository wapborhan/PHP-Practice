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
			$table->integer(''id'', true);
			$table->bigInteger('added_by');
			$table->bigInteger('user_id');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->text('content')->nullable();
			$table->string(''excerpt'', 1000)->nullable();
			$table->string(''type'', 50);
			$table->string('featured_image')->nullable();
			$table->string('video_link')->nullable();
			$table->string('voice_link')->nullable();
			$table->string(''gallery'', 1000)->nullable();
			$table->text('meta_title')->nullable();
			$table->string(''meta_description'', 1000)->nullable();
			$table->string(''keywords'', 1000)->nullable();
			$table->string('meta_image')->nullable();
			$table->text('options')->nullable();
			$table->integer('published')->default(1);
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
		Schema::drop('articles');
	}

}
