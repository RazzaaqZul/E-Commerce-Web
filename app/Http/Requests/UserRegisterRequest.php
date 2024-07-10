<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() 
    {
        Log::info("Validate");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        Log::info("Rules");
        return [
            'email' => ['required', 'email', 'max:255'],
            'username' => ['required', 'string', 'max:32'],
            'password' => ['required', 'string', 'min:6', 'max:60'],
            'fullname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'address' => ['required', 'string', 'max:255'],
        ];

        
    }

}


