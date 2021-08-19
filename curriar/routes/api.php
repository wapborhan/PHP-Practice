<?php

Route::prefix('v1/auth')->group(function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
    Route::post('social-login', 'Api\AuthController@socialLogin');
    Route::post('password/create', 'Api\PasswordResetController@create');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});

Route::prefix('v1')->group(function () {

    Route::apiResource('business-settings', 'Api\BusinessSettingController')->only('index');
    Route::apiResource('general-settings', 'Api\GeneralSettingController')->only('index');
    Route::apiResource('settings', 'Api\SettingsController')->only('index');


    Route::get('user/info/{id}', 'Api\UserController@info')->middleware('auth:api');
    Route::post('user/info/update', 'Api\UserController@updateName')->middleware('auth:api');
    Route::get('user/shipping/address/{id}', 'Api\AddressController@addresses')->middleware('auth:api');
    Route::post('user/shipping/create', 'Api\AddressController@createShippingAddress')->middleware('auth:api');
    Route::get('user/shipping/delete/{id}', 'Api\AddressController@deleteShippingAddress')->middleware('auth:api');


});

Route::get('packages', 'PackagesController@ajaxGetPackages')->name('packages-api');
Route::get('DeliveryTimes', 'PackagesController@ajaxGetDeliveryTimes')->name('deliveryTimes-api');

Route::get('countries', 'CountryController@countriesApi')->name('countries-api');
Route::get('states', 'ShipmentController@ajaxGetStates')->name('states-api');
Route::get('areas', 'ShipmentController@ajaxGetAreas')->name('areas-api');
Route::get('shipments', 'ShipmentController@index')->name('shipments-api');
Route::get('shipment-by-barcode', 'ShipmentController@ajaxGetShipmentByBarcode')->name('shipments-barcode');
Route::get('notifications', 'ShipmentController@ajaxGetNotifications')->name('notifications-api');

Route::post('addAddress', 'ClientController@addNewAddressAPI')->name('add-address');
Route::get('getAddresses', 'ClientController@getAddressesAPI')->name('get-addresses');

Route::get('missions', 'Api\MissionController@getCaptainMissions')->name('captain-missions');
Route::post('changeMissionStatus', 'Api\MissionController@changeMissionApi')->name('change-missionStatus');
Route::post('createMission', 'ShipmentController@createMissionAPI')->name('create.mission');
Route::get('ConfirmationTypeMission', 'ShipmentController@getConfirmationTypeMission')->name('confirmation.type.mission');
Route::get('checkGoogleMap', 'Api\BusinessSettingController@googleMapSettings')->name('check.googleMap');

Route::get('payment-types', 'Api\ShipmentController@getPaymentTypes')->name('payment-types');
Route::get('languages', 'Api\LanguageController@getLanguages')->name('languages');
Route::get('shipment-setting', 'Api\ShipmentController@getSetting')->name('shipment-setting');
Route::get('branchs', 'Api\BranchController@getBranchs')->name('branchs');

Route::post('client/register','ClientController@apiSave')->name('client.api.save');

Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});
