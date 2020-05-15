<?php

Route::group(['prefix' => 'backend'], function() {

  Route::get('', function () {
    return redirect('backend/template/index');
  });
  Route::get('template', function () {
    return redirect('backend/template/index');
  });

  Auth::routes();



  Route::get('pages-login', 'backend\SkoteController@index');
  Route::get('pages-login-2', 'backend\SkoteController@index');
  Route::get('pages-register', 'backend\SkoteController@index');
  Route::get('pages-register-2', 'backend\SkoteController@index');
  Route::get('pages-recoverpw', 'backend\SkoteController@index');
  Route::get('pages-recoverpw-2', 'backend\SkoteController@index');
  Route::get('pages-lock-screen', 'backend\SkoteController@index');
  Route::get('pages-lock-screen-2', 'backend\SkoteController@index');
  Route::get('pages-404', 'backend\SkoteController@index');
  Route::get('pages-500', 'backend\SkoteController@index');
  Route::get('pages-maintenance', 'backend\SkoteController@index');
  Route::get('pages-comingsoon', 'backend\SkoteController@index');

  Route::post('keep-live', 'backend\SkoteController@live');

  Route::get('template/{any}', 'backend\HomeController@index');

}); //route group survey
