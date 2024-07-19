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
        
        // Filter product
        // $cartCheck = Cart::where('fk_id_user', $user->id_user)->get();

        // Get the user's cart or create a new one if it doesn't exist
        Log::info($userId);
        $cart = Cart::firstOrCreate(['fk_id_user' => $userId]);

        // Check if the product already exists in the cart
        $existingProduct = $cart->cartHasManyProducts()
        ->where('table_carts_products.id_product', $validatedData['id_product'])
        ->first();

        if($existingProduct) {    
            // Update the existing product's quantity and subtotal
            $cart->cartHasManyProducts()->updateExistingPivot($existingProduct->id_product, [
                'quantity' => $validatedData['quantity'],
                'subtotal' => $validatedData['subtotal']
            ]);
         } else {
            // Attach the product to the cart with additional pivot data
            $cart->cartHasManyProducts()->attach($validatedData['id_product'], [
                'quantity' => $validatedData['quantity'],
                'subtotal' => $validatedData['subtotal']
            ]);
         }


      
    }

    public function deleteCart(int $cartId, int $productId) {
        $user = Auth::user();
        
        // Retrieve the cart with the given ID that belongs to the authenticated user
        $cart = Cart::where('fk_id_user', $user->id_user)
        ->where('id_cart', $cartId)
        ->first();

        if ($cart) {
            // Check if the product exists in the cart
            $product = $cart->cartHasManyProducts()->where('table_carts_products.id_product', $productId)->first();
    
            if ($product) {
                // Detach the specific product from the cart
                $cart->cartHasManyProducts()->detach($productId);
                
                // Check if the cart is empty, and delete the cart if it is
                if ($cart->cartHasManyProducts()->count() == 0) {
                    $cart->delete();
                }
            } else {
                Log::warning('Product not found in the cart');
            }
        } else {
            Log::warning('Cart not found or does not belong to the authenticated user');
        }
    }   

}
