<?php

use App\Http\Controllers\Dota2PositionController;
use App\Http\Controllers\MatchmakingRankingController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TeamRegistrationController;
use App\Repositories\DiscordAuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('team-registrations', TeamRegistrationController::class);
Route::apiResource('dota-2-positions', Dota2PositionController::class);
Route::apiResource('mmrs', MatchmakingRankingController::class);
Route::apiResource('regions', RegionController::class);

