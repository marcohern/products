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
});