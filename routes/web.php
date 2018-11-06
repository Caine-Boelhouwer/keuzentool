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

// Logout and remove all sessions
Route::get('/logout', function () {
  Auth::logout();
  Session::flush();
  return Redirect::to('/');
});

// Error routes.
Route::get('error/403', 'ErrorController@error403');
Route::get('error/404', 'ErrorController@error404');

Route::get('/', 'FilterController@search');
Route::post('/zoeken', 'FilterController@request');
Route::get('/zoeken/{ambient_temp}/{max_temp}/{min_temp}/{location}', 'FilterController@results');
Route::post('/berichten/opslaan', 'MessageController@store'); //-- Store

Auth::routes();

// *** AUTH ROUTES ***
// These routes are protected with de middlware auth.
// Visitor always need to authenticate.
Route::group(['middleware' => 'auth'], function () {

  Route::get('/development', 'DashboardController@development'); //-- Dev

  // Rest Call
  // Route::get('/rest/get/contact/{id}', 'RestController@getContact'); //-- get Contact

  // Profile
  Route::get('/systeem/profiel', 'ProfileController@index'); //-- Show
  Route::get('/systeem/profiel/bewerken', 'ProfileController@edit'); //-- Edit
  Route::post('/systeem/profiel/bewerken', 'ProfileController@update'); //-- Update

  // Dashboard
  // Route::get('/dashboard', 'DashboardController@index'); //-- Overview
  Route::get('/admin', function () {
    return redirect('/systeem/gebruikers');
  }); //-- Overview

  // Only availible for users with roles
  Route::group(['middleware' => 'hasAccess:sudo,user'], function () {

    // Users
    Route::get('/systeem/gebruikers', 'UserController@index'); //-- Overview
    Route::get('/systeem/gebruikers/archief', 'UserController@archive'); //-- Archive
    Route::get('/systeem/gebruikers/bewerken/{id}', 'UserController@edit'); //-- Edit
    Route::get('/systeem/gebruikers/verwijderen/{id}', 'UserController@destroy'); //-- Destroy
    Route::get('/systeem/gebruikers/archief/{id}', 'UserController@archiving'); //-- Archiving
    Route::get('/systeem/gebruikers/herstellen/{id}', 'UserController@restore'); //-- Restore
    Route::get('/systeem/gebruikers/aanmaken', 'UserController@create'); //-- Create
    Route::post('/systeem/gebruikers/opslaan', 'UserController@store'); //-- Store
    Route::get('/systeem/gebruikers/{id}', 'UserController@show'); //-- Show
    Route::get('/systeem/gebruikers/password/reset/{id}', 'UserController@resetPassword'); //-- Reset Password
    Route::post('/systeem/gebruikers/update/{id}', 'UserController@update'); //-- Update
    Route::post('/systeem/gebruikers/archief/bulk', 'UserController@bulkArchive'); //-- Bulk archive
    // ----------------------

    // Insulation
    Route::get('/isolatie', 'InsulationController@index'); //-- Overview
    Route::get('/isolatie/archief', 'InsulationController@archive'); //-- Archive
    Route::get('/isolatie/bewerken/{id}', 'InsulationController@edit'); //-- Edit
    Route::get('/isolatie/verwijderen/{id}', 'InsulationController@destroy'); //-- Destroy
    Route::get('/isolatie/archief/{id}', 'InsulationController@archiving'); //-- Archiving
    Route::get('/isolatie/herstellen/{id}', 'InsulationController@restore'); //-- Restore
    Route::get('/isolatie/aanmaken', 'InsulationController@create'); //-- Create
    Route::post('/isolatie/opslaan', 'InsulationController@store'); //-- Store
    Route::get('/isolatie/{id}', 'InsulationController@show'); //-- Show
    Route::post('/isolatie/update/{id}', 'InsulationController@update'); //-- Update
    Route::post('/isolatie/archief/bulk', 'InsulationController@bulkArchive'); //-- Bulk archive
    // ----------------------

    // Messages
    Route::get('/berichten', 'MessageController@index'); //-- Overview
    Route::get('/berichten/verwijderen/{id}', 'MessageController@destroy'); //-- Destroy
    Route::get('/berichten/{id}', 'MessageController@show'); //-- Show
    // ----------------------

  });

});
