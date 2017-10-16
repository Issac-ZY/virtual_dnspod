<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Welcome to use virtual dnspod api(virtual_dnspod).';
});

//Virtual DNSPOD api
Route::post('Record.Create', 'VirtualDnspodController@addRecord');
Route::post('Record.List', 'VirtualDnspodController@listRecord');
Route::post('Record.Modify', 'VirtualDnspodController@modifyRecord');
Route::post('Record.Remove', 'VirtualDnspodController@delRecord');
Route::get('User.Detail','VirtualDnspodController@getUserDetail');

