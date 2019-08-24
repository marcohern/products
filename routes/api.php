<?php

Route::group([
  'namespace' => 'Marcohern\Products\Http\Controllers',
  'prefix' => 'mh/prd',
  'middleware' => ['api']
], function () {
  Route::resources([
    'product'    => 'ProductController',
    'attributes' => 'AttributesController',
    'category'   => 'CategoryController',
    'settings'   => 'SettingsController',
  ]);

  Route::post('product/{id}/hit'  , 'ProductController@hit')->name('product-hit');
  Route::post('product/{id}/click', 'ProductController@click')->name('product-click');
  Route::post('product/{id}/sale' , 'ProductController@sale')->name('product-sale');
  Route::post('product/{id}/rate' , 'ProductController@rate')->name('product-rate');
});