<?php 
Route::get('client/register','ClientController@register')->name('client.register');
Route::post('client/register','ClientController@save')->name('client.save');
Route::post('client/new-address','ClientController@addNewAddress')->name('client.add.new.address');
Route::get('client/get-address','ClientController@getOneAddress')->name('client.get.one.address');

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff|branch']], function(){
	//Update Routes
    Route::resource('clients','ClientController',[
        'as' => 'admin'
    ]);

});

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff']], function(){
    Route::get('clients/delete/{client}','ClientController@destroy')->name('admin.clients.delete-client');
});