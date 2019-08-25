<?php

namespace Marcohern\Products;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
  public function products() {
    return $this->belongsToMany(
      Product::class,
      'product_prdcats',
      'category_id',
      'product_id');
  }
}
