<?php

use App\Http\Helpers\TransactionHelper;


Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff']], function(){
	//Update Routes
	Route::get('clients/transactions/{client_id}','TransactionController@getClientTransaction')->name('admin.client.transactions.show');
	Route::get('captains/transactions/{captain_id}','TransactionController@getCaptainTransaction')->name('admin.captain.transactions.show');
    Route::resource('transactions','TransactionController',[
        'as' => 'admin'
    ]);

});
Route::get('admin/reverce_config',function(){
	
	$str = file_get_contents(base_path('addons/spot-cargo-shipment-addon/config.json'));
	$config = json_decode($str, true);
	if (!empty($config['files'])) {
		foreach ($config['files'] as $file) {
			copy(base_path($file['update_directory']), base_path($file['root_directory']));
		}
	}
});