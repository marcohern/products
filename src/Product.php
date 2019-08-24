<?php

namespace Marcohern\Products;

use Illuminate\Database\Eloquent\Model;

use Marcohern\Products\Exceptions\ProductNotFoundException;

class Product extends Model
{
  public static function findByIdOrSlug($id) : Product {
    $product = null;
    if (is_numeric($id)) $product = self::find($id);
    else $product = self::select()->where('slug','=',$id)->first();
    if (!$product) {
      throw new ProductNotFoundException("Product not found: $id",0xf0fd140f44);
    }
    return $product;
  }
}
