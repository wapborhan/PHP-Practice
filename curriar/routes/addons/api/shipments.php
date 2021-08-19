<?php 

// Route::post('api/admin/shipments/create', 'ShipmentController@storeAPI')->name('api.admin.shipments.store');


Route::post('api/admin/shipments/create', array('uses' => 'ShipmentController@storeAPI','middleware' => ['checkHeader']))->name('api.admin.shipments.store');
