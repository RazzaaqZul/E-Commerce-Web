<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard() : Response
    {
        Log::info('Masuk Ke Halaman Dashboard');
        return Inertia::render('Dashboard');
    }
}
