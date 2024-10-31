<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
   public function index()  {
    return Product::all();
   }
   public function filterProducts(Request $request)
{
    
    $minPrice = $request->query('min_price');
    $maxPrice = $request->query('max_price');
    $sortOrder = $request->query('order', 'asc');
    $available = $request->query('available');
    $category = $request->query('category');  

    
    $query = Product::query();

    if ($category !== null) {
        $query->where('category', $category);
    }

  
    if ($minPrice !== null) {
        $query->where('price', '>=', $minPrice);
    }

   
    if ($maxPrice !== null) {
        $query->where('price', '<=', $maxPrice);
    }

   
    $query->orderBy('price', $sortOrder);

   
    if ($available !== null) {
        $query->where('available', $available);
    }

    
    $products = $query->get();

 
    return response()->json($products);
}
}
