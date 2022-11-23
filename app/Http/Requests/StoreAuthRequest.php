<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Nom d'utilisateur requis.",
            'email.required' => 'Adresse email requise.',
            'email.email' => 'Adresse email invalide.',
            'password.required' => 'Mot de passe requis.',
            'confirm-password.required' => 'Confirmation du mot de passe requise.',
            'confirm-password.same' => 'Les mots de passe ne correspondent pas.',
        ];
    }
}
