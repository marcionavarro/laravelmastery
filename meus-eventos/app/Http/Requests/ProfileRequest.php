<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,' . auth()->id()
        ];

        //dd($this->request->get('user')['password']); //Não funciona
        if($this->request->all('user')['password']){
            $rules['user.password'] = 'string|min:8|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Estes campos são obrigatórios',
            'min' => 'A senha deve ter pelo menos :min caracteres',
            'confirmed' => 'A senha e a confirmação da senha não batem!',
            'unique' => 'Este e-mail já está sendo utilizado por outro usuário',
        ];
    }
}
