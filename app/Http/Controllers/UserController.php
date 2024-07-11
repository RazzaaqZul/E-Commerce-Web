<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function login() : Response
    {
        Log::info('Masuk Ke Halaman Login');
        return Inertia::render('Login');
    }



    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        Log::warning('Masuk Ke dalam authenticate' . json_encode($credentials));

        if(Auth::attempt($credentials )){
            Log::warning('Masuk Ke dalam Auth Attempt');
            $request->session()->put("user", $credentials);

            return to_route('dashboard');
        }

        // Jika gagal
        return Inertia::render('Login', [
            "error" => [ 
                "message" => "username or password wrong!"
                ]
        ]); 
    }


    public function register() : Response
    {
        Log::info('Masuk Ke Halaman Register');
        return Inertia::render('Register');
    }

    public function doRegister(UserRegisterRequest $request)
    {
        
        // Validasi request dan dapatkan data yang divalidasi
        $data = $request->validated();

        if (User::where('email', $data['email'])->exists() || User::where('username', $data['username'])->exists()) {
            Log::error('Email or username already exists');
                
            // Render halaman register dengan pesan error
            return Inertia::render('Register', [
                "error" => [
                    "message" => "Email or username already exists"
                ]
            ]);
        }


        $user = new User($data);

        $user->password = Hash::make($data['password']);
        $user->save();
        return to_route('login');

    }

}
