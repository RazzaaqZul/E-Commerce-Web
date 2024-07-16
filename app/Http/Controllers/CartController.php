<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        $cart = new Cart();
        $carts = Cart::where('fk_id_user', $user->id_user)->get();
        // Retrieve products with pivot data (quantity, subtotal) if the cart exists
        $products = [];
        foreach ($carts as $cart) {
            $cartProducts = $cart->cartHasManyProducts()->get()->map(function($product) {
                return [
                    'cart_id' => $product->pivot->id_cart,
                    'detail' => [
                        'id' => $product->id_product,
                        'name' => $product->name,
                        'price' => $product->price,
                        'description' => $product->description,
                        'path_image' => $product->path_image,
                        'stock' => $product->stock,
                    ],
                    'quantity' => $product->pivot->quantity,
                    'subtotal' => $product->pivot->subtotal
                ];
            });
            $products = array_merge($products, $cartProducts->toArray());
        }
        

        // Return the view with the cart products data
        return Inertia::render('Cart', [
            'products' => $products
        ]);
    } 

    public function addCart(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
            'id_product' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer'
        ]);
      
        // Get the authenticated user
        $user = Auth::user();
        $userId = $user->id_user;

        // Create a new cart instance and save it
        $cart = new Cart();
        $cart->fk_id_user = $userId;
        $cart->save();

        // Attach the product to the cart with additional pivot data
        $cart->cartHasManyProducts()->attach($validatedData['id_product'], [
            'quantity' => $validatedData['quantity'],
            'subtotal' => $validatedData['subtotal']
        ]);
    }

    public function deleteCart(int $cartId) {
        $user = Auth::user();
        
        // Retrieve the cart with the given ID that belongs to the authenticated user
        $cart = Cart::where('fk_id_user', $user->id_user)->where('id_cart', $cartId)->first();

        if ($cart) {
            // Detach all products associated with this cart
            $cart->cartHasManyProducts()->detach();

            // Delete the cart itself
            $cart->delete();
        } else {
            Log::warning('Cart not found or does not belong to the authenticated user');
        }
    }   

}
