<?php

namespace Marcohern\Products\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Marcohern\Slugifier\Lib\Slugifier;

use Marcohern\Products\ProductCategory;
use Marcohern\Products\Http\Requests\IndexProductCategoryRequest;
use Marcohern\Products\Http\Requests\CreateProductCategoryRequest;
use Marcohern\Products\Http\Requests\UpdateProductCategoryRequest;
class CategoryController extends Controller
{
  protected $slugifier;

  public function __construct(Slugifier $slugifier) {
    $this->slugifier = $slugifier;
  }

  public function index(IndexProductCategoryRequest $request)
  {
    $q = $request->input('q','');
    $rpp = $request->input('rpp', 10);

    $query = ProductCategory::select();
    if (!empty($q)) {
      $query->where('name','LIKE',"%$q%");
    }
    return $query->paginate($rpp);
  }
  
  public function store(CreateProductCategoryRequest $request)
  {
    $category = new ProductCategory;
    $category->name = $request->name;
    $category->slug = $request->input('slug',
      $this->slugifier->storeSlug($request->name,'product-categories')
    );
    $category->type = 'product';
    $category->ord = $request->ord;
    $category->lvl = $request->lvl;
    $category->save();
    return [ 'id' => $category->id ];
  }
  
  public function show($id)
  {
    return ProductCategory::findByIdOrSlug($id);
  }
  
  public function update(UpdateProductCategoryRequest $request, $id)
  {
    $category = ProductCategory::findByIdOrSlug($id);
  }
  
  public function destroy($id)
  {
    ProductCategory::findByIdOrSlug($id)->delete();
  }
}
