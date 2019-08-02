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
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('/dashboard', 'HomeController@dashboard');

	Route::get('/profile', 'UserController@profile');
	Route::resource('/users', 'UserController');

    // Category Routes
    Route::resource('/categories', 'CategoryController');
    Route::get('/delete-category/{id}', 'CategoryController@destroy');
//    Route::post('/edit-category/{id}', 'CategoryController@update');

    // Faculty Routes
    Route::resource('/faculties', 'FacultyController');
    Route::get('/delete-faculty/{id}', 'FacultyController@destroy');
    Route::post('/edit-faculty/{id}', 'FacultyController@update');

	// Department Routes
	Route::resource('/departments', 'DepartmentController');
    Route::get('/delete-department/{id}', 'DepartmentController@destroy');
    Route::post('/edit-department/{id}', 'DepartmentController@update');



});


// Route::get('dashboard', function() {
//   return view('/dashboard');
// })->middleware('auth');

Auth::routes();



