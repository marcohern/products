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

  public static function index() {
    return self::select(['id','name','slug']);
  }

  public static function findByIdOrSlug($id) : ProductCategory {
    $category = null;
    $type = null;
    if (is_numeric($id)) {
      $category = self::find($id);
      $type = 'id';
    }
    else {
      $category = self::select()->where('slug','=',$id)->first();
      $type = 'slug';
    }
    if (!$category) {
      throw new ProductNotFoundException("Product Category not found. $type '$id'",0xf1ed131f45);
    }
    return $category;
  }
}
