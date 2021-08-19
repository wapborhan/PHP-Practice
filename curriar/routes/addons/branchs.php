<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//Update Routes
    Route::resource('branchs','BranchController',[
        'as' => 'admin'
    ]);
    Route::get('branchs/delete/{branch}','BranchController@destroy')->name('admin.branchs.delete-branch');

});