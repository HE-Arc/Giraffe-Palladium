<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateShareRequest extends FormRequest
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
    public function rules()
    {
        return [
            'item' => ['required', 'exists:items,id'],
            'otherUser' => ['required', 'string', 'max:255'],
            'since' => ['required', 'date'],
            'deadline' => ['nullable', 'date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'item.required' => "L'objet est requis.",
            'item.string' => "L'objet doit être une chaîne de caractères.",
            'item.exists' => "L'objet n'existe pas.",
            'otherUser.required' => "Le nom de la personne est requis.",
            'otherUser.string' => "Le nom de la personne doit être une chaîne de caractères.",
            'otherUser.max' => "Le nom pour la personne est trop long.",
            'since.required' => "La date de début est requise.",
            'since.date' => "La date de début n'est pas valide",
            'deadline.date' => "La date de fin  n'est pas valide",
        ];
    }
}
