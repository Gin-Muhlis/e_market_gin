<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanStoreRequest extends FormRequest
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
            'no_faktur' => ['required', 'max:50', 'string'],
            'tgl_faktur' => ['required', 'date'],
            'total_bayar' => ['required', 'numeric'],
            'pelanggan_id' => ['required', 'exists:pelanggans,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
