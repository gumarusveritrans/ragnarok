<?php

Route::get('/', 'ConnectPagesController@home');
Route::get('/about', 'ConnectPagesController@about');
Route::get('/contact', 'ConnectPagesController@contact');
Route::get('/pricing', 'ConnectPagesController@pricing');
Route::get('/product', 'ConnectPagesController@product');
Route::get('/login', 'CustomersController@login');
Route::get('/register', 'CustomersController@register');

Route::get('/customers/dashboard', 'CustomersController@dashboard');
Route::get('/customers/profile', 'CustomersController@profile');
Route::get('/customers/transaction', 'CustomersController@transaction');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/increase-limit', 'CustomersController@increase_limit');
Route::get('/customers/increase-limit-success', 'CustomersController@increase_limit_success');
Route::get('/customers/change-password-success', 'CustomersController@change_password_success');
Route::get('/customers/close-account-success', 'CustomersController@close_account_success');
Route::get('/customers/transfer-success', 'CustomersController@transfer_success');
Route::get('/customers/topup-success', 'CustomersController@topup_success');
Route::get('/customers/purchase-success', 'CustomersController@purchase_success');
Route::get('/customers/topup', 'CustomersController@topup');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/purchase', 'CustomersController@purchase');
Route::get('/customers/register-success', 'CustomersController@register_success');

Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/notification', 'AdminController@notification');
Route::get('/admin/manage-user', 'AdminController@manage_user');


Route::get('upload', function() {
  return View::make('customers.increase-limit');
});
Route::post('apply/upload', 'CustomersController@upload');

//Route for Validation Form
Route::post('register-form', 'CustomersController@validate_registration_form');
Route::post('login-form', 'CustomersController@validate_login_form');
Route::post('topup-form', 'CustomersController@validate_topup_form');
Route::post('transfer-form', 'CustomersController@validate_transfer_form');
Route::post('close-account-form', 'CustomersController@validate_close_account_form');
Route::post('change-password-form', 'CustomersController@validate_change_password_form');