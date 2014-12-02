<?php

/*
 * Depends on a Y-n-j date format
 *
 * It could be improved to return false if the user isn't already 18
 * Currently allows users who are 17 to join the network
 *;
 */

Validator::extend('check_age', function($attribute, $value)
{
	$year = substr($value, 0, 4);

	$yearRange = get_year_range();

	if ($year > $yearRange['min'] or $year < $yearRange['max'])
	{
		return false;
	}

	return true;
});

define('NUM_MESSAGES', 10);
define('NEWER_MESSAGES', 1);
define('OLDER_MESSAGES', 2);

define('_HOST', "localhost:8000");

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('account/register', 'AccountsController@create');
Route::post('account', 'AccountsController@store');
Route::get('account/edit', 'AccountsController@edit');
Route::put('account/edit', 'AccountsController@update');

Route::get('login', 'SessionsController@create');
Route::post('login', 'SessionsController@store');
Route::get('logout', 'SessionsController@destroy');

Route::get('user/{id}', 'ProfilesController@show');
Route::get('profile/edit', 'ProfilesController@edit');
Route::put('profile/edit', 'ProfilesController@update');

// could replace 'profile/edit' and 'account/edit' above with 'profile' and 'edit'

Route::get('conversations', 'ConversationsController@index');
Route::post('conversation', 'MessagesController@store');
Route::get('conversation/{id}/{option?}/{offset?}', 'ConversationsController@show');

Route::get('test', function()
{
	return Request::url();
});
