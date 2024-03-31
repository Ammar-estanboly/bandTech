<?php

namespace App\Http\Requests\Product;

use App\Rules\PriceFormat;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'is_active'   =>'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => ['array',new PriceFormat],
            'slug' => ['string','unique:products,slug,'. $this->product->id],
        ];
    }
}
