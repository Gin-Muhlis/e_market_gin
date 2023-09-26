<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TampungBayarStoreRequest extends FormRequest
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
            'penjualan_id' => ['required', 'exists:penjualans,id'],
            'total' => ['required', 'numeric'],
            'terima' => ['required', 'numeric'],
            'kembali' => ['required', 'numeric'],
        ];
    }
}
