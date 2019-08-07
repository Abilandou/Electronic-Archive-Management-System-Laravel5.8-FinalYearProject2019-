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

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware' => ['auth']], function(){
    Route::resource('faculties', 'FacultyController');
    Route::resource('departments', 'DepartmentController');
    Route::post('/edit-faculty/{id}', 'FacultyController@update');
    Route::resource('categories', 'CategoryController');
    Route::resource('roles', 'RoleController');
// });
