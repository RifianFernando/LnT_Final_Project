<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:5|string|max:80',
            'category' => 'required|string|max:255',
            'quantity'=>'required|numeric|min:1',
            //'image ' => 'required|mimes:jpeg,jpg,png,gif',
            'price' => 'required|numeric'
        ];
    }
    
    public function messages()
    {
        return [
            'name.min' => 'Nama produk minimal 5 karakter',
            'name.max' => 'Nama produk maksimal 80 karakter',
            'quantity.min' => 'Jumlah produk minimal 1',
            //'image' => 'file harus berupa gambar',
            'price.numeric' => 'harga harus berupa angka',
            'quantity.numeric' => 'jumlah harus berupa angka',
        ];
    }
}
