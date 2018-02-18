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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/support', 'HomeController@pageSupport')->name('support');
Route::get('/terms-and-conditions', 'HomeController@pageTermsCondition')->name('terms-and-conditions');
Route::get('/privacy-policy', 'HomeController@pagePrivacyPolicy')->name('privacy-policy');
Route::get('/containers', 'HomeController@showContainers')->name('containers');
Route::get('/profile', 'HomeController@showProfile')->name('profile');

Route::get('/create_company', 'HomeController@showCreateCompanyPage')->name('profile');
Route::post('/create_company_submit', 'HomeController@submitCreateCompany');