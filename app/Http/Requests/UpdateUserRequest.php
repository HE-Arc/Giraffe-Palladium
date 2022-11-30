<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // TODO oof
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'nullable',
            'password' => 'confirmed|nullable'
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
            'description.nullable' => 'Description invalide.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.'
        ];
    }
}
