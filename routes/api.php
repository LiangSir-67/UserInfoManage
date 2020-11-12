<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//使用钉钉扫码
Route::post('ddsaoma','UserInfoController@ddSaoMa');

//查看历史信息
Route::post('getuserinfo','UserInfoController@getUserInfo');


//record manager 入住记录管理
Route::prefix('data')->group(function () {
    Route::get('inoutd','DataViewsController@LabInOut1');
    Route::get('inoutm','DataViewsController@LabInOut2');

});


//table 1
Route::get('test','DataViewsController@select');
