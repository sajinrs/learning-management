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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return redirect('login');
});

Route::get('/admin', function () {
    return redirect('admin/dashboard');
});

Auth::routes();

//Route::get('/', 'PageController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {    

        Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');

        //Roles
        Route::resource('roles', 'AdminRolesController');
        Route::get('roles/modules/{id}', 'AdminRolesController@modules')->name('roles.modules');
        Route::post('roles/update-permission/{id}', 'AdminRolesController@updatePermission')->name('roles.update-permission');  

        //Employees
        Route::resource('employees', 'AdminUserController');
        Route::resource('centers', 'AdminCenterController');
        Route::resource('batches', 'AdminBatchController');
        

    });
});
