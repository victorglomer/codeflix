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




// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('email-verification/error', 'EmailVerificationController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'EmailVerificationController@getVerification')->name('email-verification.check');

Route::get('/home', 'HomeController@index');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
        ], function () {

    Route::name('users.updatesenha')->post('updatesenha', 'UsersController@updatesenha');

    Route::name('login')->get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');

    Route::name('logout')->post('logout', 'Auth\LoginController@logout');

    Route::group(['middleware' => ['taVerificado', 'can:admin', 'TrocouSenha']], function () {

        Route::get('dashboard', function() {
            return view('admin.dashboard');
        });

        Route::resource('users', 'UsersController');
        Route::resource('category', 'CategoryController');
        Route::resource('series', 'SeriesController');
        Route::name('series.thumb_asset')
            ->get('series/{serie}/thumb_asset', 'SeriesController@thumbAsset');
        Route::name('series.thumb_small_asset')
            ->get('series/{serie}/thumb_small_asset', 'SeriesController@thumbSmallAsset');

        Route::group(['prefix' => 'videos', 'as' => 'videos.'], function() {
            Route::name('relations.create')->get('{video}/relations', 'VideoRelationsController@create');
            Route::name('relations.store')->post('{video}/relations', 'VideoRelationsController@store');

            Route::name('uploads.create')->get('{video}/uploads', 'VideoUploadsController@create');
            Route::name('uploads.store')->post('{video}/uploads', 'VideoUploadsController@store');
        });

        Route::name('videos.video_file_asset')
            ->get('videos/{video}/video_file_asset', 'VideosController@videoFileAsset');

        Route::resource('videos', 'VideosController');
        
        
        
    });

    Route::get('troca-senha', 'UsersController@trocaSenha');
    Route::post('admin.users.updatesenha', 'UsersController@updateTrocaSenha');

});
