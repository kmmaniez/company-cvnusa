<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'kategori_id' => ['required'], 
            'user_id' => ['required'], 
            'title' => ['required','string','max:50'],
            'slug' => ['required','string','max:50'],
            'thumbnail' => ['image','mimes:png,jpg,jpeg','max:2048'],
        ];
    }
}
