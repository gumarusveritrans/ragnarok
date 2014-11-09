<?php

Route::get('/', 'ConnectPagesController@home');

//Route for Connect Pages
Route::get('/about', 'ConnectPagesController@about');
Route::get('/contact', 'ConnectPagesController@contact');
Route::get('/pricing', 'ConnectPagesController@pricing');
Route::get('/product', 'ConnectPagesController@product');
Route::get('/login', 'CustomersController@login');
Route::post('/login', 'CustomersController@login');
Route::get('/register', 'CustomersController@register');
// Route::post('/register', 'CustomersController@register');

//Route for Customers Section
Route::get('/customers/dashboard', 'CustomersController@dashboard');
Route::get('/customers/download-csv-topup', 'CustomersController@download_csv_topup');
Route::get('/customers/download-csv-transfer', 'CustomersController@download_csv_transfer');
Route::get('/customers/download-csv-purchase', 'CustomersController@download_csv_purchase');
Route::get('/customers/profile', 'CustomersController@profile');
Route::get('/customers/transaction', 'CustomersController@transaction');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/increase-limit', 'CustomersController@increase_limit');
Route::post('/customers/increase-limit-post', 'CustomersController@increase_limit_post');
Route::get('/customers/topup', 'CustomersController@topup');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::post('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/purchase', 'CustomersController@purchase');
Route::post('/customers/logout', array('as' => 'customer_logout','uses'=>'CustomersController@logout'));

//Route for Admin Section
Route::get('/admin/login', 'AdminController@login');
Route::post('/admin/login', 'AdminController@login');
Route::post('/admin/logout', 'AdminController@logout');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/download-csv-topup', 'AdminController@download_csv_topup');
Route::get('/admin/download-csv-transfer', 'AdminController@download_csv_transfer');
Route::get('/admin/download-csv-purchase', 'AdminController@download_csv_purchase');
Route::get('/admin/notification', 'AdminController@notification');
Route::get('/admin/manage-user', 'AdminController@manage_user');
Route::post('/admin/redeem_user', 'AdminController@redeem_user');
Route::post('/admin/reject_increase_limit', 'AdminController@reject_increase_limit');
Route::post('/admin/accept_increase_limit', 'AdminController@accept_increase_limit');
Route::post('/admin/create_merchant', ['before' => 'csrf', 'uses' => 'AdminController@create_merchant']);

//Route for Merchant Section
Route::get('/merchants/login', 'MerchantsController@login');
Route::post('/merchants/login', 'MerchantsController@login');
Route::post('/merchants/logout','MerchantsController@logout');
Route::get('/merchants/transaction', 'MerchantsController@transaction');
Route::get('/merchants/list-products', 'MerchantsController@list_products');

//Route for Validation Form
Route::post('registration-form', 'CustomersController@validate_registration_form');
Route::post('login-form', 'CustomersController@validate_login_form');
Route::post('topup-form', 'CustomersController@validate_topup_form');
Route::post('transfer-form', 'CustomersController@validate_transfer_form');
Route::post('close-account-form', 'CustomersController@validate_close_account_form');
Route::post('change-password-form', 'CustomersController@validate_change_password_form');

Route::post('user-information-form', 'CustomersController@validate_user_information_form');
Route::post('upload-id-card', 'CustomersController@upload');
Route::get('/upload', 'CustomersController@getUploadForm');

//Route for Validation Form
Route::post('admin-login-form', 'AdminController@validate_login_form');

