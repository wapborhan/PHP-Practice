<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uploads', function(Blueprint $table)
		{
			$table->integer(''id'', true);
			$table->string('file_original_name')->nullable();
			$table->string('file_name')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('file_size')->nullable();
			$table->string(''extension'', 10)->nullable();
			$table->string(''type'', 15)->nullable();
			$table->timestamps(10);
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('uploads');
	}

}
