<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function createOrder(Request $request) {
        $validatedData = $request->validate([
            'order_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|boolean',
        ]);
      
        $user = Auth::user();
        $order = new Order($validatedData);
        $order->fk_id_user = $user->id_user;
        $order->save();
    }

    
    public  function order(Request $request, int $productId) {
        
        $detailProducts = Product::where('id_product', $productId)->first();

        return Inertia::render('DetailOrder',[
            'detailProduct' => [ 
                $detailProducts
            ],
            'queryParams' => [
                $request
            ]
        ]);
    }
}
