<?php

use Illuminate\Support\Facades\Route;
use App\Models\Segment;

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
    '/branches/dataSource', 
    [App\Http\Controllers\BranchController::class, 'branchesDataSourceAjax']
)->name('branches.datasource');

Route::post(
    '/agents/dataSource', 
    [App\Http\Controllers\AgentController::class, 'agentsDataSourceAjax']
)->name('agents.datasource');

Route::post(
    '/deals/dataSource', 
    [App\Http\Controllers\DealController::class, 'dataSourceAjax']
)->name('deals.datasource');

Route::post(
    '/clients/massEdit', 
    [App\Http\Controllers\ClientController::class, 'massEdit']
)->name('clients.massEdit');

Route::post(
    '/deals/massEdit', 
    [App\Http\Controllers\DealController::class, 'massEdit']
)->name('deals.massEdit');

Route::post(
    '/clients/loadInput', 
    [App\Http\Controllers\ClientController::class, 'loadInput']
)->name('clients.loadInput');

Route::post(
    '/deals/loadInput', 
    [App\Http\Controllers\DealController::class, 'loadInput']
)->name('deals.loadInput');

Route::resource('clients', App\Http\Controllers\ClientController::class);
Route::resource('segments', App\Http\Controllers\SegmentController::class);
Route::get('/segments/forget/{segment}', [App\Http\Controllers\SegmentController::class, 'forget']);
Route::get('/segments/typeList/{type}', [App\Http\Controllers\SegmentController::class, 'indexType']);
Route::post(
    '/fieldvalues/values/',
    [App\Http\Controllers\FieldValueController::class, 'values']
)->name("fieldvalue.values");
Route::resource('fieldvalues', App\Http\Controllers\FieldValueController::class);
Route::resource('agents', App\Http\Controllers\AgentController::class);
Route::resource('branches', App\Http\Controllers\BranchController::class);
Route::resource('deals', App\Http\Controllers\DealController::class);
Route::get('/deals/ajax/{deal}', [App\Http\Controllers\DealController::class, 'ajaxGet'])->name('deals.ajaxGet');
