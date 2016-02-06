<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Everything in this group the user has to be authenticated.
Route::group(['middleware' => ['oauth'],'before' => ['oauth']], function (){
	//route to get currentuser
	Route::get('/users/current','UserController@current');
});


	Route::post('oauth/access_token', function() {
 		return Response::json(Authorizer::issueAccessToken());
	});


Route::post('/users/register', 'UserController@register');


