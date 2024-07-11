<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function getDetailProduct(int $productId) 
    {

        Log::info("Ini data detail Product");
        // $productId = 1;
        $detailProducts = Product::where('id_product', $productId)->first();

        return Inertia::render('DetailProduct', [
            'detailProduct' => [ 
                $detailProducts
            ]
        ]);
    }
}
