<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'product_name' => 'required|max:200',
            'product_code' => 'required|max:30',
            'product_price' => 'required|numeric|gt:0',
            'product_color' => 'required|max:200',
            'family_color' => 'required|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required',
            'product_name.required' => 'Product Name is required',
            'product_code.required' => 'Product Code is required',
            'product_price.required' => 'Product Price is required',
            'product_price.numeric' => 'Valid Product Price is required',
            'product_color.required' => 'Product Color is required',
            'family_color.required' => 'Family Color is required',

        ];
    }
}
