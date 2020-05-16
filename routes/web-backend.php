<?php

Route::group(['prefix' => 'backend','namespace' => 'Backend',  'as' => 'backend.'], function() {

  Route::get('', function () {
    return redirect('backend/index');
  });
  Route::get('template', function () {
    return redirect('backend/template/index');
  });


  // Authentication Routes...
  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login')->name('login');
  Route::get('logout', 'Auth\LoginController@logout')->name('logout');




  Route::get('pages-login', 'SkoteController@index');
  Route::get('pages-login-2', 'SkoteController@index');
  Route::get('pages-register', 'SkoteController@index');
  Route::get('pages-register-2', 'SkoteController@index');
  Route::get('pages-recoverpw', 'SkoteController@index');
  Route::get('pages-recoverpw-2', 'SkoteController@index');
  Route::get('pages-lock-screen', 'SkoteController@index');
  Route::get('pages-lock-screen-2', 'SkoteController@index');
  Route::get('pages-404', 'SkoteController@index');
  Route::get('pages-500', 'SkoteController@index');
  Route::get('pages-maintenance', 'SkoteController@index');
  Route::get('pages-comingsoon', 'SkoteController@index');

  Route::post('keep-live', 'SkoteController@live');

  Route::get('template/{any}', 'HomeController@index');

}); //route group survey
