<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard() : Response
    {
        $products = Product::all();
        Log::info("Ini data Product", $products->toArray());
        return Inertia::render('Dashboard', [
            'dataProducts' => $products
        ]);
    }

    
}
