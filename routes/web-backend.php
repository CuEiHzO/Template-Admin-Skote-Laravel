<?php
#===========================================================================================================================================================
Route::group(['prefix' => 'backend','namespace' => 'Backend',  'as' => 'backend.'], function() {
#===========================================================================================================================================================
  // Authentication Routes...
  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login')->name('login');
  Route::get('logout', 'Auth\LoginController@logout')->name('logout');

  #=========================================================================================================================================================
  Route::group(['middleware' => ['auth:admin']], function () {
  #=========================================================================================================================================================
    Route::get('', 'HomeController@index');
    Route::get('index', 'HomeController@index');



 
      Route::resource('banner', 'BannerController');
      Route::post('banner/datatable', 'BannerController@Datatable')->name('banner.datatable');


      Route::resource('instagram', 'InstagramController');
      Route::post('instagram/datatable', 'InstagramController@Datatable')->name('instagram.datatable');


      Route::resource('label-slide', 'LabelSlideController');
      Route::post('label-slide/datatable', 'LabelSlideController@Datatable')->name('label-slide.datatable');



      Route::resource('promotion', 'PromotionController');
      Route::post('promotion/datatable', 'PromotionController@Datatable')->name('promotion.datatable');

  



    #=======================================================================================================================================================
    Route::group(['prefix' => 'permission','namespace' => 'Permission',  'as' => 'permission.'], function() {
    #=======================================================================================================================================================
      Route::resource('admin', 'AdminController');
      Route::post('admin/datatable', 'AdminController@Datatable')->name('datatable');

    #=======================================================================================================================================================
    }); //route group permission
    Route::get('template/{any?}', 'TemplateController@index')->name('template');
  #=========================================================================================================================================================
  }); //route group auth:admin
#===========================================================================================================================================================
}); //route group backend
