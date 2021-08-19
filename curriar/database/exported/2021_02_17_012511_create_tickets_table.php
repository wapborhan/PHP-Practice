<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->integer(''id'', true);
			$table->integer('code');
			$table->integer('user_id');
			$table->string('subject');
			$table->text('details')->nullable();
			$table->text('files')->nullable();
			$table->string(''status'', 10)->default('pending');
			$table->integer('viewed')->default(0);
			$table->integer('client_viewed')->default(0);
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
		Schema::drop('tickets');
	}

}
