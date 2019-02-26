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

/*
 * Player routes
 */

Route::get('players', 'PlayerController@index')
    ->name('api.players.index');

Route::get('players/{player}', 'PlayerController@show')
    ->name('api.players.show')
    ->where('player', '[0-9]+');

Route::post('players', 'PlayerController@store')
    ->name('api.players.store');

Route::put('players/{player}', 'PlayerController@update')
    ->name('api.players.update')
    ->where('player', '[0-9]+');

Route::delete('players/{player}', 'PlayerController@delete')
    ->name('api.players.delete')
    ->where('player', '[0-9]+');


/*
 * Leaderboard routes
 */

Route::get('leaderboard', 'LeaderboardController@index')
    ->name('api.leaderboard.index');


