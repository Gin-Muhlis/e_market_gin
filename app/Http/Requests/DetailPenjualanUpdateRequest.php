<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailPenjualanUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'harga_jual' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
            'penjualan_id' => ['required', 'exists:penjualans,id'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ];
    }
}
