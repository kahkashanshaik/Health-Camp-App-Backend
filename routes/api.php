<?php

use Illuminate\Http\Request;
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
Route::prefix('v1')->group(function () {
    // Campaigns
    Route::get('/campaigns', 'CampaignController@list');
    Route::get('/campaign/{id}', 'CampaignController@get');
    // Volunteers login
    Route::post('/volunteer/login', 'VolunteerAuthController@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Volunteers logout
        Route::post('/volunteer/logout', 'VolunteerAuthController@logout');
    });
});