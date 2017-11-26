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
Route::match(['post','get','put', 'options'], 'api/...', 'Api\XController@method')->middleware('cors');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'API\PassportController@getDetails');
});
Route::Get('films', 'FilmController@getAllFilms')->middleware('cors');
Route::Get('films/{slug}', 'FilmController@getFilmWithSlug');
Route::Post('films/addfilm', 'FilmController@addFilm');
Route::Post('films/addcomment/{filmId}', 'FilmController@addComment')->middleware('auth:api');;
Route::Get('films/getcomments/{filmId}', 'FilmController@getComments');











