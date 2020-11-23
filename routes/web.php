<?php

use Illuminate\Support\Facades\Route;

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

Route::post(
    '/clients/dataSource', 
    [App\Http\Controllers\ClientController::class, 'clientsDataSourceAjax']
)->name('clients.datasource');

Route::post(
    '/clients/massEdit', 
    [App\Http\Controllers\ClientController::class, 'massEdit']
)->name('clients.massEdit');

Route::post(
    '/clients/loadInput', 
    [App\Http\Controllers\ClientController::class, 'loadInput']
)->name('clients.loadInput');

Route::resource('clients', App\Http\Controllers\ClientController::class);
Route::resource('segments', App\Http\Controllers\SegmentController::class);
Route::post(
    '/fieldvalues/values/',
    [App\Http\Controllers\FieldValueController::class, 'values']
)->name("fieldvalue.values");
Route::resource('fieldvalues', App\Http\Controllers\FieldValueController::class);
