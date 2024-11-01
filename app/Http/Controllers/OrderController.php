<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // استرجاع جميع الطلبات للمستخدم
        $orders = Order::where('user_id', Auth::id())->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'address' => 'required|string',
        ]);
    
       
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
            'address' => $request->address, 
           
        ]);
    
       
        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }
    
        return response()->json($order->load('products'), 201); // إرجاع الطلب مع تفاصيل المنتجات
    }

    public function show($id)
{
    // استرجاع طلب معين مع تفاصيل المنتجات
    $order = Order::with('products')->findOrFail($id);
    return response()->json($order);
}

    public function update(Request $request, $id)
    {
        // تحديث طلب معين
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy($id)
    {
        // حذف طلب معين
        Order::destroy($id);
        return response()->json(null, 204);
    }
}