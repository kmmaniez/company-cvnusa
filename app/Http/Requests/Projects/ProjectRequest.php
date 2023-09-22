<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'nama_project' => ['required'],
            'thumbnail' => ['required','image','mimes:png,jpg,jpeg','max:2048'],
            'gambar_project' => ['required'], // validasi 
            'gambar_project.*' => ['image','mimes:png,jpg,jpeg','max:2048'], // validasi 
            'finish_date' => ['required','date'],
        ];
    }

    public function messages(): array
    {
        return [
            'thumbnail.required' => 'Thumbnail wajib diisi!',
            'thumbnail.image' => 'Gambar harus berformat PNG,JPG,JPEG!',
            'gambar_project' => 'Gambar project minimal 1 gambar (PNG,JPG,JPEG) Maksimal 2Mb!',
            'gambar_project.*' => 'Gambar project minimal 1 gambar (PNG,JPG,JPEG) Maksimal 2Mb!',
        ];
    }
}
