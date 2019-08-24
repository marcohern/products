<?php

namespace Marcohern\Products\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Marcohern\Slugifier\Lib\Slugifier;

use Marcohern\Products\Product;
use Marcohern\Products\Http\Requests\IndexProductRequest;
use Marcohern\Products\Http\Requests\CreateProductRequest;
use Marcohern\Products\Http\Requests\UpdateProductRequest;

use Marcohern\Products\Exceptions\ProductNotFoundException;

class ProductController extends Controller
{
  protected $slugifier;

  public function __construct(Slugifier $slugifier) {
    $this->slugifier = $slugifier;
  }

  public function index(IndexProductRequest $request)
  {
    $q = $request->input('q','');
    $rpp = $request->input('rpp', 10);

    $query = Product::select()->where('visible','=',true);
    if (!empty($q)) {
      $query->where('name','LIKE',"%$q%");
    }
    return $query->paginate($rpp);
  }
  
  public function store(CreateProductRequest $request)
  {
    $product = new Product;
    $product->name = $request->name;
    $product->slug = $request->input('slug',
      $this->slugifier->store($request->name,'products')['slug']
    );
    $product->overview = $request->overview;
    $product->description = $request->description;
    $product->org_price = $request->org_price;

    $product->dct_price = $request->input('dct_price',null);
    $product->qty = $request->input('qty', 0);

    $product->visible = $request->input('visible', true);
    $product->hot     = $request->input('hot', false);
    $product->hot_until = $request->input('hot_until', null);
    $product->featured = $request->input('featured', false);
    $product->parent_id = $request->input('parent_id', null);

    $product->hits = $request->input('hits', 0);
    $product->clicks = $request->input('clicks', 0);
    $product->sales_count = $request->input('sales_count', 0);
    $product->sales_value = $request->input('sales_value', 0);
    $product->rating_count = $request->input('rating_count', 0);
    $product->rating_value = $request->input('rating_value', 0);

    $product->save();

    return [
      'id' => $product->id
    ];
  }
  
  public function show(string $id)
  {
    $product = null;
    if (is_numeric($id)) $product = Product::find($id);
    else $product = Product::select()->where('slug','=',$id)->first();
    if (!$product) {
      throw new ProductNotFoundException("Product not found: $id",0xf0fd140f44);
    }
    return $product;
  }
  
  public function update(UpdateProductRequest $request, string $id)
  {
    $product = null;
    if (is_numeric($id)) $product = Product::find($id);
    else $product = Product::select()->where('slug','=',$id)->first();
    if (!$product) {
      throw new ProductNotFoundException("Product not found: $id",0x931ee91869);
    }

    $product->name        = $request->input('name',$product->name);
    $product->slug        = $request->input('slug',$product->slug);
    $product->overview    = $request->input('overview',$product->overview);
    $product->description = $request->input('description',$product->description);
    $product->org_price   = $request->input('org_price',$product->org_price);

    $product->dct_price = $request->input('dct_price',$product->dct_price);
    $product->qty       = $request->input('qty', $product->qty);

    $product->visible   = $request->input('visible', $product->visible);
    $product->hot       = $request->input('hot', $product->hot);
    $product->hot_until = $request->input('hot_until', $product->hot_until);
    $product->featured  = $request->input('featured', $product->featured);
    $product->parent_id = $request->input('parent_id', $product->parent_id);

    $product->hits         = $request->input('hits', $product->hits);
    $product->clicks       = $request->input('clicks', $product->clicks);
    $product->sales_count  = $request->input('sales_count', $product->sales_count);
    $product->sales_value  = $request->input('sales_value', $product->sales_value);
    $product->rating_count = $request->input('rating_count', $product->rating_count);
    $product->rating_value = $request->input('rating_value', $product->rating_value);
    $product->save();
  }
  
  public function destroy(string $id)
  {
    $product = null;
    if (is_numeric($id)) $product = Product::find($id);
    else $product = Product::select()->where('slug','=',$id)->first();
    if (!$product) {
      throw new ProductNotFoundException("Product not found: $id",0x7dbd484686);
    }
    $product->delete();
  }
}
