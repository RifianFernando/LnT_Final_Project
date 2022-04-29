<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class invoiceRequest extends FormRequest
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
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|integer|digits:5',
        ];
    }
    
    public function message(){
        return [
            'shipping_address.required' => 'Alamat pengiriman harus diisi',
            'shipping_address.string' => 'Alamat pengiriman harus berupa string',
            'shipping_address.min' => 'Alamat pengiriman minimal 10 karakter',
            'shipping_address.max' => 'Alamat pengiriman maksimal 100 karakter',
            'postal_code.required' => 'Kode pos harus diisi',
            'postal_code.digits' => 'Kode pos wajib 5 karakter',
            'postal_code.integer' => 'Kode pos harus berupa angka',
        ];
    }
}
