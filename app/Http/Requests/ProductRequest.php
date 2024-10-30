<?php

namespace App\Http\Requests;

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
    public function rules(): array
    {
        return [
            'name' =>['required','max:255'],
            'description' =>['required','max:255'],
            'price' =>['required','numeric','min:0'],
            'quantity' =>['required','integer','min:0'],
            'attribute_name' => ['required'],
            'attribute_value' => ['required'],
            'attribute_price' => ['required'],
            // 'image' => ['required','image','mime:png,jpg,jpeg,gif']
        ];
    }
}
