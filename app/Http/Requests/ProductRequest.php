<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'title')->ignore($productId),
            ],
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => 'Já existe um produto com esse nome',
            
        ];
    }
}
