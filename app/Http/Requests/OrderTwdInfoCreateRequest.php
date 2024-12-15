<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTwdInfoCreateRequest extends FormRequest
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
            'id' => 'required|string|max:255|unique:order_infos,show_order_id',
            'name' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.district' => 'required|string|max:255',
            'address.street' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'currency' => 'required|in:TWD,USD,JPY,RMB,MYR',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The order ID is required.',
            'id.string' => 'The order ID must be a string.',
            'id.max' => 'The order ID must not exceed :max characters.',
            'id.unique' => 'The order ID has already been taken.',
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed :max characters.',
            'address.city.required' => 'The city in the address is required.',
            'address.city.string' => 'The city in the address must be a string.',
            'address.city.max' => 'The city must not exceed :max.',
            'address.district.required' => 'The district in the address is required.',
            'address.district.string' => 'The district in the address must be a string.',
            'address.district.max' => 'The district must not exceed :max.',
            'address.street.required' => 'The street in the address is required.',
            'address.street.string' => 'The street in the address must be a string.',
            'address.street.max' => 'The street must not exceed :max.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least :min.',
            'price.max' => 'The price must not exceed :max.',
            'currency.required' => 'The currency is required.',
            'currency.in' => 'The selected currency is invalid.',
        ];
    }
}
