<?php

namespace Marcohern\Products;

use Illuminate\Database\Eloquent\Model;

use Marcohern\Products\Exceptions\ProductNotFoundException;

class Product extends Model
{
  public function categories() {
    return $this->belongsToMany(
      ProductCategory::class,
      'product_prdcats',
      'product_id',
      'category_id');
  }

  public static function index() {
    return self::select([
      'id','name','slug','org_price','dct_price','qty',
      'visible','hot','hot_until','featured','parent_id',
      'hits','clicks','rating_count','rating_value'
    ]);
  }

  public static function findByIdOrSlug($id) : Product {
    $product = null;
    $type = null;
    if (is_numeric($id)) {
      $product = self::find($id);
      $type = 'id';
    }
    else {
      $product = self::select()->where('slug','=',$id)->first();
      $type = 'slug';
    }
    if (!$product) {
      throw new ProductNotFoundException("Product not found. $type '$id'",0xf0fd140f44);
    }
    return $product;
  }
}
