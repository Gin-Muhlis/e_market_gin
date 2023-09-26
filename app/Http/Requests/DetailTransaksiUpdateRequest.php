<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailTransaksiUpdateRequest extends FormRequest
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
            'jumlah_bayar' => ['required', 'numeric'],
            'transaksi_id' => ['required', 'exists:transaksis,id'],
            'jenis_pembayaran_id' => [
                'required',
                'exists:jenis_pembayarans,id',
            ],
        ];
    }
}
