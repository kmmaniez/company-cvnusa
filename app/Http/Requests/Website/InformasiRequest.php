<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class InformasiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email'],
            'telepon' => ['required','numeric'],
            'alamat' => ['required','string'],
            'logo' => ['nullable','image','mimes:png,jpg,jpeg','max:2048'],
            'facebook' => ['nullable','url'],
            'instagram' => ['nullable','url'],
            'twitter' => ['nullable','url'],
            'linkedin' => ['nullable','url'],
        ];
    }
}
