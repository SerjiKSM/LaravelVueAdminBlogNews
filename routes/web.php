<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'AdminController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/add-category','NewsCategoryController@addCategory');
    Route::get('categories','NewsCategoryController@allCategory');
    Route::get('edit-category/{id}','NewsCategoryController@editCategory');
    Route::post('update-category/{id}','NewsCategoryController@updateCategory');

    Route::post('/add-news','NewsController@addNews');
    Route::get('news-list','NewsController@allNews');
    Route::get('/edit-news/{id}','NewsController@editNews');
    Route::post('/update-news/{id}','NewsController@updateNews');
    Route::get('/news-by-category/{id}','NewsController@newsByCategory');
    Route::get('/news/{id}','NewsController@newsById');
    Route::post('/update-number-views/{id}','NewsController@updateNumberViews');

    Route::get('auth-user','AdminController@getAuthUser');
});
