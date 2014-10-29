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
Route::get('/customers/transfer-success', 'CustomersController@transfer_success');
Route::get('/customers/topup-success', 'CustomersController@topup_success');
Route::get('/customers/topup', 'CustomersController@topup');
Route::get('/customers/transfer', 'CustomersController@transfer');
Route::get('/customers/purchase', 'CustomersController@purchase');
Route::get('/admin/login', 'AdminController@login');

Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/notification', 'AdminController@notification');
Route::get('/admin/manage-user', 'AdminController@manage_user');