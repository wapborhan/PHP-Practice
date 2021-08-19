<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff|captain|branch']], function(){
    Route::post('missions/action/{to}','MissionsController@change')->name('admin.missions.action');
    Route::post('missions/action/approve/{to}','MissionsController@approveAndAssign')->name('admin.mission.action.approve');
    Route::get('missions/action/confirm_amount/{mission_id}','MissionsController@getAmountModel')->name('admin.missions.action.confirm_amount');
    Route::get('missions/manifests/','MissionsController@getManifests')->name('admin.missions.manifests');
    Route::post('missions/manifests/order','MissionsController@ajax_change_order')->name('admin.missions.manifests.order');
    Route::post('missions/manifest-profile','MissionsController@getManifestProfile')->name('admin.missions.get.manifest');
    Route::post('missions/reschedule','MissionsController@reschedule')->name('admin.missions.reschedule');
    
    Route::resource('missions','MissionsController',[
        'as' => 'admin'
    ]);
    foreach(\App\Mission::status_info() as $item)
    {
        $params ='';
        if(isset($item['optional_params']))
        {
            $params = $item['optional_params'];
        }
        Route::get('missions/'.$item['route_url'].'/{status}'.$params,'MissionsController@statusIndex')
        ->name($item['route_name']);
    }
});