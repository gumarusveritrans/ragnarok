<?php

Route::get('/', 'ConnectPagesController@home');

//Route for Connect Pages
Route::get('/about', 'ConnectPagesController@about');
Route::get('/contact', 'ConnectPagesController@contact');
Route::get('/pricing', 'ConnectPagesController@pricing');
Route::get('/product', 'ConnectPagesController@product');
Route::get('/reset-password','ConnectPagesController@reset_password');
Route::post('/reset-password',['before' => 'csrf','uses'=>'ConnectPagesController@reset_password']);
Route::get('/login', 'ConnectPagesController@login');
Route::post('/login', 'ConnectPagesController@login');
Route::get('/register', 'ConnectPagesController@register');
Route::post('registration-form', ['before' => 'csrf', 'uses' => 'ConnectPagesController@register']);

//Route for Customers Section
Route::get('/customers/dashboard', 'CustomersController@dashboard');
Route::get('/customers/download-csv', 'CustomersController@download_csv');
Route::get('/customers/profile', 'CustomersController@profile');
Route::get('/customers/transaction', 'CustomersController@transaction');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/increase-limit', 'CustomersController@increase_limit');
Route::post('/customers/increase-limit', ['before' => 'csrf', 'uses' => 'CustomersController@increase_limit']);
Route::get('/customers/topup', 'CustomersController@topup');
Route::post('/customers/topup', ['before' => 'csrf','uses'=>'CustomersController@topup']);
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::post('/customers/transfer', ['before' => 'csrf', 'uses' => 'CustomersController@transfer']);
Route::get('/customers/purchase', 'CustomersController@purchase');
Route::post('/customers/purchase_products',array('before'=> 'csrf-ajax','uses'=>'CustomersController@purchase_products'));
Route::post('/customers/logout', array('as' => 'customer_logout','uses'=>'CustomersController@logout'));

//Route for Admin Section
Route::get('/admin/login', 'AdminController@login');
Route::post('/admin/login', 'AdminController@login');
Route::post('/admin/logout', 'AdminController@logout');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/download-csv', 'AdminController@download_csv');
Route::get('/admin/notification', 'AdminController@notification');
Route::get('/admin/manage-user', 'AdminController@manage_user');
Route::post('/admin/redeem_user', ['before'=>'csrf','uses'=>'AdminController@redeem_user']);
Route::post('/admin/add-product', array('as' => 'add-product', 'uses' => 'AdminController@add_product'));
Route::post('/admin/reject_increase_limit', ['before'=>'csrf','uses'=>'AdminController@reject_increase_limit']);
Route::post('/admin/accept_increase_limit', ['before'=>'csrf','uses'=>'AdminController@accept_increase_limit']);
Route::post('/admin/create_merchant', ['before' => 'csrf', 'uses' => 'AdminController@create_merchant']);
Route::post('/admin/delete_merchant',['before' =>'csrf','uses' =>'AdminController@delete_merchant']);

//Route for Merchant Section
Route::get('/merchants/login', 'MerchantsController@login');
Route::post('/merchants/login', 'MerchantsController@login');
Route::post('/merchants/logout','MerchantsController@logout');
Route::get('/merchants/transaction', 'MerchantsController@transaction');
Route::get('/merchants/download-csv', 'MerchantsController@download_csv');
Route::get('/merchants/list-products', 'MerchantsController@list_products');
Route::post('merchants/reject-purchase',['before'=>'csrf','uses'=>'MerchantsController@reject_purchase']);

//Route for Validation Form
Route::post('close-account-form', ['before'=>'csrf','uses'=>'CustomersController@validate_close_account_form']);
Route::post('change-password-form', ['before'=>'csrf','uses'=>'CustomersController@validate_change_password_form']);
Route::post('user-information-form', 'CustomersController@validate_user_information_form');
Route::post('upload-id-card', 'CustomersController@upload');
Route::get('/upload', 'CustomersController@getUploadForm');
Route::post('/notification-handling', 'NotificationController@getMessage');