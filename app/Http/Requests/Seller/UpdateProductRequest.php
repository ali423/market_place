<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $seller = auth()->user();
        $seller_profile=$seller->sellerProfile;
        return [
            'title' => ['required', Rule::unique('products','title')
                ->where('seller_profile_id', $seller_profile->id)
            ->whereNot('id',$this->product->id)
            ],
            'count' => ['required', 'integer', 'max:10000'],
            'price' => ['required', 'integer'],
            'image' => ['nullable', 'image','max:1024'],
            'discount' => ['nullable', 'integer', 'max:100'],
        ];
    }
}
