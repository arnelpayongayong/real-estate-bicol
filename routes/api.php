<?php

use App\Models\House;
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

Route::group(['middleware' => 'auth:api'], function () {



});

Route::post('house/create','HouseController@store');
Route::get('house/index','HouseController@index');
Route::get('house/search/{id}','HouseController@edit');
Route::put('house/edit/{id}','HouseController@update');
// AUTH

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::post('submission/confirmation', 'Api\SubmissionController@confirmation');
Route::post('submissions', 'Api\SubmissionController@register');

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::resource('users', 'UserController');
  Route::resource('roles', 'RoleController');
  Route::get('permissions', 'RoleController@getPermissions');
  Route::get('role_permissions', 'RoleController@checkRolePermission');
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');
  Route::get('auth/user', 'AuthController@user');
  // ADMIN ROUTES
  Route::get('submissions', 'Api\AdminSubmissionController@index');
  Route::resource('promocodes', 'Api\PromoCodeController');
  Route::resource('categories', 'Api\CategoryController');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});


Route::get('testing',function(){
  // $house = App\Models\House::find(1);

  // foreach($house->images as $image)
  // {
  // }

  // return $house;
   Storage::delete('KDMpK1vDWgw1KOjS1JxEyFxr7VO2JEqdjJAx9Lxc.png');
    
});

Route::post('image/store','ImageController@store');
Route::post('feature/store','FeatureController@store');

Route::delete('feature/{id}', 'FeatureController@destroy');


Route::post('agent/store','AgentController@store');
Route::get('agent/list','AgentController@index');

Route::post('sample/email','HouseController@sendEmail');