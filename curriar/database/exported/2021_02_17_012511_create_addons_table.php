<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addons', function(Blueprint $table)
		{
			$table->integer(''id'', true);
			$table->string('name')->nullable();
			$table->string('unique_identifier')->nullable();
			$table->string('version')->nullable();
			$table->integer('activated')->default(1);
			$table->string(''image'', 1000)->nullable();
			$table->timestamps(10);
			$table->text('files')->nullable();
			$table->text('required_addons')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addons');
	}

}
