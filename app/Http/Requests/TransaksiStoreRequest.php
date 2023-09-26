<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiStoreRequest extends FormRequest
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
            'kode_transaksi' => ['required', 'max:255', 'string'],
            'tgl_bayar' => ['required', 'date'],
            'user_input' => ['required', 'max:255', 'string'],
            'rombel_id' => ['required', 'exists:rombels,id'],
        ];
    }
}
