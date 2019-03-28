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

//Route::group([
//    'prefix' => 'admin',
//    'as' => 'admin.',
//    ],
//    function() {
//    Route::get('/', function(){
//        return "AREA ADM";
//    });
//    });
//        Route::name('logout')->get('logout', 'Auth\LoginController@logout');
//        Route::name('logout')->post('logout', 'Auth\LoginController@logout');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
        ], function () {

//    Route::post('users.updatesenha', 'UsersController@updateTrocaSenha');    
    Route::name('users.updatesenha')->post('updatesenha', 'UsersController@updatesenha');    
    
    Route::name('login')->get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');

    Route::name('logout')->post('logout', 'Auth\LoginController@logout');

    Route::group(['middleware' => ['taVerificado', 'can:admin', 'TrocouSenha']], function () {

        Route::get('dashboard', function() {
            return view('admin.dashboard');
        });

        Route::resource('users', 'UsersController');
        Route::resource('categorias', 'CategoriasController');
    });
    
    Route::get('troca-senha', 'UsersController@trocaSenha');
    Route::post('admin.users.updatesenha', 'UsersController@updateTrocaSenha');

//    Route::get('troca-senha', function () {
//        //
//    })->middleware('TrocouSenha');
});
