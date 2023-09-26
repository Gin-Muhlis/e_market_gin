<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RombelStoreRequest extends FormRequest
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
            'rombel' => ['required', 'max:255', 'string'],
        ];
    }
}
