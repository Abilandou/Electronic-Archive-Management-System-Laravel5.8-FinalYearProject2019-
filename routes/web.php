<?php
// use Illuminate\Routing\Route;

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

	// User Routes
	Route::get('/profile', 'UserController@profile');
	Route::resource('/users', 'UserController');
	Route::post('/add-fac-user', 'UserController@addFacultyUsers');
	Route::match(['get', 'post'],'/add-maintainer', 'UserController@addMaintainer');
    Route::get('/delete-user/{id}', 'UserController@destroy');
    Route::match(['post', 'get'],'/edit-fac-user/{id}', 'UserController@editFacultyUser');
    Route::post('/edit-user/{id}', 'UserController@update');

    // Category Routes
    Route::resource('/categories', 'CategoryController');
    Route::get('/delete-category/{id}', 'CategoryController@destroy');
    Route::post('/edit-category/{id}', 'CategoryController@update');

    // Faculty Routes
    Route::resource('/faculties', 'FacultyController');
    Route::get('/delete-faculty/{id}', 'FacultyController@destroy');
    Route::post('/edit-faculty/{id}', 'FacultyController@update');


	// Department Routes
	Route::resource('/departments', 'DepartmentController');
    Route::get('/delete-department/{id}', 'DepartmentController@destroy');
    Route::post('/edit-department/{id}', 'DepartmentController@update');


    //Roles/Permissions Routes
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::get('/delete-role/{id}', 'RoleController@destroy');
    Route::get('/delete-permission/{id}', 'PermissionController@destroy');
    Route::post('/edit-role/{id}', 'RoleController@update');
    Route::post('/edit-permission/{id}', 'PermissionController@update');

    //Logs controller
    Route::get('logs', 'LogController@log');
    Route::get('logDel', 'LogController@logdel');


});


// Route::get('dashboard', function() {
//   return view('/dashboard');
// })->middleware('auth');

Auth::routes();



