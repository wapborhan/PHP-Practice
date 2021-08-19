<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('referred_by')->nullable();
			$table->string(''provider_id'', 50)->nullable();
			$table->string(''user_type'', 10)->default('customer');
			$table->string(''name'', 191);
			$table->string(''email'', 191)->nullable()->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->text('verification_code')->nullable();
			$table->text('new_email_verificiation_code')->nullable();
			$table->string(''password'', 191)->nullable();
			$table->string(''api_token'', 80)->nullable()->unique();
			$table->string(''remember_token'', 100)->nullable();
			$table->string(''avatar'', 256)->nullable();
			$table->string(''avatar_original'', 256)->nullable();
			$table->string(''address'', 300)->nullable();
			$table->string(''country'', 30)->nullable();
			$table->string(''city'', 30)->nullable();
			$table->string(''postal_code'', 20)->nullable();
			$table->string(''phone'', 20)->nullable();
			$table->float(''balance'', 20)->default(0.00);
			$table->boolean('banned')->default(0);
			$table->string('referral_code')->nullable();
			$table->integer('customer_package_id')->nullable();
			$table->integer('remaining_uploads')->nullable()->default(0);
			$table->timestamps(10);
			$table->boolean('role_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
