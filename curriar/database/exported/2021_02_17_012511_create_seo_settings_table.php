<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seo_settings', function(Blueprint $table)
		{
			$table->integer(''id'', true);
			$table->string('keyword');
			$table->string('author');
			$table->integer('revisit');
			$table->string('sitemap_link');
			$table->text('description');
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
		Schema::drop('seo_settings');
	}

}
