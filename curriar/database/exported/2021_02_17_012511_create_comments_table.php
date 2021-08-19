<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->integer(''id'', true);
			$table->string(''type'', 50);
			$table->bigInteger('item_id');
			$table->bigInteger('parent_id');
			$table->bigInteger('added_by');
			$table->string('author_name')->nullable();
			$table->string('author_email')->nullable();
			$table->string('author_avatar')->nullable();
			$table->string('comment')->nullable();
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
		Schema::drop('comments');
	}

}
