<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
  
    public function index()  
    {
        return Product::all();
    }

      public function filterProducts(Request $request)
    {
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        $sortOrder = $request->query('order', 'asc');
        $available = $request->query('available');
        $category = $request->query('category');  
        $subcategory = $request->query('subcategory');

        $query = Product::query();

        if ($category !== null) {
            $query->where('category', $category);
        }

        if ($subcategory !== null) {
            $query->where('subcategory', $subcategory);
        }

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($available !== null) {
            $query->where('available', $available);
        }

        $query->orderBy('price', $sortOrder);

        $products = $query->get();

        return response()->json($products);
    }

   
    public function getSubcategories(Request $request)
    {
        $category = $request->query('category');
    
        if (!$category) {
            return response()->json([
                'error' => 'يرجى تحديد القسم الرئيسي.'
            ], 400);
        }
    
      
        $subcategories = Product::where('category', $category)
            ->whereNotNull('subcategory')
            ->distinct()
            ->pluck('subcategory');
    
        return response()->json($subcategories);
    }
}