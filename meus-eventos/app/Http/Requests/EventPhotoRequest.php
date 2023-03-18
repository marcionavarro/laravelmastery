<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photos.*' => 'image'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'image' => 'Um ou mais arquivos de imagem são inválidos!'
        ];
    }
}
