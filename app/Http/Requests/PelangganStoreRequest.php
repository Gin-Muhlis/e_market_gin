<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PelangganStoreRequest extends FormRequest
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
            'kode_pelanggan' => ['required', 'max:50', 'string'],
            'nama' => ['required', 'max:50', 'string'],
            'alamat' => ['required', 'max:200', 'string'],
            'no_telp' => ['required', 'max:20', 'string'],
            'email' => ['required', 'unique:pelanggans,email', 'email'],
        ];
    }
}
