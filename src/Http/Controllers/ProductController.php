<?php

namespace Marcohern\Products\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Marcohern\Products\Product;
use Marcohern\Products\Http\Requests\IndexProductRequest;
use Marcohern\Products\Http\Requests\CreateProductRequest;
use Marcohern\Products\Http\Requests\UpdateProductRequest;

use Marcohern\Products\Exceptions\ProductNotFoundException;

class ProductController extends Controller
{
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
      $product->slug = $request->slug;
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
        throw new ProductNotFoundException("Product not found: $id");
      }
      return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
