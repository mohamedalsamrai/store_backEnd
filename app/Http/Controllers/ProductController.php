<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Product::query();
    
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
    
        $products = $query->get();
    
        return view('products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'detail' => 'nullable|string',
        'category' => 'required|string',
        'discount_percentage' => 'nullable|numeric|min:0|max:100',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'available' => 'required|boolean',
    ]);

    $imagePath = $request->file('image_path')->store('products', 'public');
    $fullImagePath = url('storage/' . $imagePath);

    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->detail = $request->detail;
    $product->category = $request->category;
    $product->discount_percentage = $request->discount_percentage;
    $product->image_path = $fullImagePath; 
    $product->available = $request->available;
    $product->save();
    $this->reorderProductIDs();

    return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
}


    /**
     * Display the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    

     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'price' => 'required|numeric',
             'detail' => 'nullable|string',
             'category' => 'required|string',
             'discount_percentage' => 'nullable|numeric|min:0|max:100',
             'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'available' => 'required|boolean',
         ]);
     
         $product = Product::findOrFail($id);
         $product->name = $request->name;
         $product->price = $request->price;
         $product->detail = $request->detail;
         $product->category = $request->category;
         $product->discount_percentage = $request->discount_percentage;
         $product->available = $request->available;
     
     
         if ($request->hasFile('image_path')) {
          
             Storage::disk('public')->delete(str_replace(url('storage/'), '', $product->image_path));
    
             $imagePath = $request->file('image_path')->store('products', 'public');
             
             
             $product->image_path = url('storage/' . $imagePath);
         }
     
         $product->save();
     
         return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        $product = Product::findOrFail($id);
    
      
        if ($product->image_path) {
            Storage::disk('public')->delete(str_replace(url('storage/'), '', $product->image_path));
        }
    
      
        $product->delete();
    
        
        $this->reorderProductIds();
    
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
    
    private function reorderProductIds()
    {
        
        $products = Product::orderBy('id')->get();
    
       
        foreach ($products as $index => $product) {
            $product->id = $index + 1; 
            $product->save(); 
        }
    }
}