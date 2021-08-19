<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'user_role:admin|staff|customer|captain|branch']);
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff']], function(){
	//Update Routes

	Route::resource('profile','ProfileController');

	Route::post('/update', 'UpdateController@step0')->name('update');

	Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
	Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
	Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
	Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');

	Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
	Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
	Route::get('/notifications-settings', 'BusinessSettingsController@notifications')->name('notifications.index');
	Route::post('/business-settings/update/notifications', 'BusinessSettingsController@updateNotificationsSettings')->name('business_settings.update.notifications');
	Route::get('/sms-gateways', 'BusinessSettingsController@sms_gateways')->name('sms_gateways.index');
	Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('email_settings.index');
	Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
	Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
	Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
	Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
	Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
	Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
	Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
	Route::post('/google_map', 'BusinessSettingsController@google_map_update')->name('google_map.update');
	Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
	Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

	Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
	Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');


	Route::get('/languages/export', 'LanguageController@export')->name('languages.export');
	Route::get('/languages/import', 'LanguageController@import')->name('languages.import');
	Route::post('/languages/import/parse', 'LanguageController@parseImport')->name('languages.import_parse');
	Route::post('/languages/import/process', 'LanguageController@processImport')->name('languages.import_process');

	Route::resource('/languages', 'LanguageController');
	Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
	Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
	Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
	Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');


    //Currency
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

	Route::get('/frontend_settings/home', 'HomeController@home_settings')->name('home_settings.index');
	Route::post('/frontend_settings/home/top_10', 'HomeController@top_10_settings')->name('top_10_settings.store');
	Route::get('/sellerpolicy/{type}', 'PolicyController@index')->name('sellerpolicy.index');
	Route::get('/returnpolicy/{type}', 'PolicyController@index')->name('returnpolicy.index');
	Route::get('/supportpolicy/{type}', 'PolicyController@index')->name('supportpolicy.index');
	Route::get('/terms/{type}', 'PolicyController@index')->name('terms.index');
	Route::get('/privacypolicy/{type}', 'PolicyController@index')->name('privacypolicy.index');

	//Policy Controller
	Route::post('/policies/store', 'PolicyController@store')->name('policies.store');

	Route::group(['prefix' => 'frontend_settings'], function(){
		Route::resource('sliders','SliderController');
	    Route::get('/sliders/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');

	});
	Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');
	// website setting
	Route::group(['prefix' => 'website'], function(){
		Route::view('/header', 'backend.website_settings.header')->name('website.header');
		Route::view('/footer', 'backend.website_settings.footer')->name('website.footer');
		Route::view('/pages', 'backend.website_settings.pages.index')->name('website.pages');
		Route::view('/appearance', 'backend.website_settings.appearance')->name('website.appearance');
		Route::get('/menu', 'MenuController@index')->name('website.menu.index');
		Route::get('/container', 'AdminContainerController@index')->name('website.container.index');
		Route::post('/container/store', 'AdminContainerController@store')->name('website.container.store');
		Route::get('/container/destroy/{id}', 'AdminContainerController@destroy')->name('website.container.destroy');
		Route::post('/widget/store', 'AdminWidgetController@store')->name('website.widget.store');
		Route::post('/widget/clone', 'AdminWidgetController@clone')->name('website.widget.clone');
		Route::get('/widget/destroy/{id}', 'AdminWidgetController@destroy')->name('website.widget.destroy');
		Route::post('/widget/container/update', 'AdminContainerWidgetController@update')->name('website.widget.container.update');
		Route::get('/widget/container/destroy/{id}', 'AdminContainerWidgetController@destroy')->name('website.widget.container.destroy');
		Route::get('/theme', 'AdminThemeController@index')->name('website.theme.index');
		Route::post('/theme/update/active', 'AdminThemeController@update_active')->name('website.theme.update.active');
		Route::get('/theme/option', 'AdminThemeController@options')->name('website.theme.option.index');
		Route::resource('custom-pages', 'PageController');
		Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
		Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
	});

	Route::resource('roles','RoleController');
	Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

	//Subscribers
	Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');

	// Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
	// Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
	// Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
	// Route::get('/sales', 'OrderController@sales')->name('sales.index');


	Route::resource('links','LinkController');
	Route::get('/links/destroy/{id}', 'LinkController@destroy')->name('links.destroy');

	Route::resource('seosetting','SEOController');


	//Reports



	//Support_Ticket
	Route::get('support_ticket/','SupportTicketController@admin_index')->name('support_ticket.admin_index');
	Route::get('support_ticket/{id}/show','SupportTicketController@admin_show')->name('support_ticket.admin_show');
	Route::post('support_ticket/reply','SupportTicketController@admin_store')->name('support_ticket.admin_store');


	//conversation of seller customer
	Route::get('conversations','ConversationController@admin_index')->name('conversations.admin_index');
	Route::get('conversations/{id}/show','ConversationController@admin_show')->name('conversations.admin_show');

	Route::resource('attributes','AttributeController');
	Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
	Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

	Route::resource('addons','AddonController');
	Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');
	Route::get('/addons/delete/{id}', 'AddonController@delete')->name('addons.delete.view');
	Route::get('/addons-reset', 'AddonController@resetSystem')->name('addons.reset');
	Route::get('/generate-addon', 'AddonController@generate')->name('addons.generate');
	Route::post('/generate-addon', 'AddonController@generator')->name('addons.generate.store');
	Route::get('/generate-installable-file', 'AddonController@generateInstallabeFile')->name('addons.generate.installable');


	Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');

	Route::view('/system/update', 'backend.system.update')->name('system_update');
	Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');


    //Messaging
    Route::get('/sms', 'SmsController@index')->name('sms.index');
    Route::post('/sms-send', 'SmsController@send')->name('sms.send');

});

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'user_role:admin|staff|customer|captain|branch']], function(){
	//Update Routes

    Route::get('/notifications', 'NotificationController@notifications')->name('notifications');
    Route::get('/notifications/{id}', 'NotificationController@notification')->name('notification.view');
	Route::resource('profile','ProfileController');
// uploaded files
	Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
	Route::resource('/uploaded-files', 'AizUploadController');
	Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');



});

Route::group(['middleware' => ['auth', 'user_role:admin|staff|branch']], function(){
	Route::resource('staffs','StaffController');
	Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');
});
