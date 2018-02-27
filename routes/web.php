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
Route::get('/support', 'PageController@pageSupport')->name('support');
Route::get('/terms-and-conditions', 'PageController@pageTermsCondition')->name('terms-and-conditions');
Route::get('/privacy-policy', 'PageController@pagePrivacyPolicy')->name('privacy-policy');

Route::get('/profile', 'HomeController@showProfile')->name('profile');
Route::post('/update_profile', 'HomeController@updateProfileSubmit');

Route::get('/change_password', 'HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');


Route::get('/companies', 'HomeController@companies')->name('companies');
Route::get('/create_company', 'HomeController@showCreateCompanyPage');
Route::post('/create_company_submit', 'HomeController@submitCreateCompany');
Route::get('/edit_company/{company_id}', 'HomeController@showEditCompanyPage');
Route::post('/edit_company_submit', 'HomeController@submitEditCompany');
Route::get('/remove_company/{company_id}', 'HomeController@removeCompany');

Route::get('/containers/{company_id}', 'HomeController@showContainersPage');
Route::get('/add_container/{container_id}', 'HomeController@showAddContainerPage');
Route::post('/add_container_submit', 'HomeController@addContainerSubmit');
Route::get('/edit_container/{company_id}/{container_id}', 'HomeController@showEditContainerPage');
Route::post('/edit_container_submit', 'HomeController@editContainerSubmit');
Route::get('/remove_container/{company_id}/{container_id}', 'HomeController@removeContainer');
Route::get('/show_container/{company_id}/{container_id}', 'HomeController@showContainer');
Route::get('/hide_container/{company_id}/{container_id}', 'HomeController@hideContainer');
