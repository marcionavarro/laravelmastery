<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'banner' => 'image',
            'title' => 'required|min:10',
            'description' => 'required',
            'body' => 'required',
            'start_event' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image' => 'Arquivo de imagem inválido',
            'title.required' => 'Este campo titulo é obrigatório',
            'required' => 'Este campo é obrigatório',
            'min' => 'Tamanho minimo de :min caracteres'
        ];
    }
}
