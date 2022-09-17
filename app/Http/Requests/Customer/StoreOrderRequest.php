<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
        $customer=auth()->user();
        return [
            'address_uuid'=>['required','string',Rule::exists('customer_addresses','uuid')->where('user_id',$customer->id)],
            'products'=>['required','array','min:1'],
            'products.*'=>['required',Rule::exists('products','uuid')->where('seller_profile_id',$this->seller_profile->id)],
        ];
    }
}
