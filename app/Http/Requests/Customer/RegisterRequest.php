<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.name' => ['required','string'],
            'user.email' => ['required','email','unique:users,email'],
            'user.password' => ['required','string'],
            'address'=>['required','array','min:1'],
            'address.*.address' => ['required','string'],
            'address.*.lat' => ['required','numeric','between:-90,90'],
            'address.*.lng' => ['required','numeric','between:-90,90'],
        ];
    }
}
