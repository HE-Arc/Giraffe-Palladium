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
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'lender_id' => ['nullable', 'integer', 'exists:users,id'],
            'borrower_id' => ['nullable', 'integer', 'exists:users,id'],
            'nonuser_lender' => ['nullable', 'string', 'max:255'],
            'nonuser_borrower' => ['nullable', 'string', 'max:255'],
            'since' => ['required', 'date'],
            'deadline' => ['nullable', 'date'],
            'terminated' => ['required', 'boolean'],
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
            'item_id.required' => "L'objet est requis.",
            'item_id.integer' => "L'ID de l'objet doit être un entier.",
            'item_id.exists' => "L'objet n'existe pas.",
            'lender_id.exists' => "Le prêteur n'existe pas.",
            'lender_id.integer' => "L'ID du prêteur doit être un entier.",
            'borrower_id.integer' => "L'ID de l'emprunteur doit être un entier.",
            'borrower_id.exists' => "L'emprunteur n'existe pas.",
            'nonuser_lender.string' => "Le prêteur doit être une chaîne de caractères.",
            'nonuser_lender.max' => "Le nom pour le prêteur est trop long.",
            'nonuser_borrower.string' => "L'emprunteur doit être une chaîne de caractères.",
            'nonuser_borrower.max' => "Le nom pour l'emprunteur est trop long.",
            'since.required' => "La date de début est requise.",
            'since.date' => "La date de début n'est pas valide",
            'deadline.date' => "La date de fin  n'est pas valide",
            'terminated.required' => "Le statut de l'emprunt est requis.",
            'terminated.boolean' => "Le statut de l'emprunt doit être un booléen.",
        ];
    }
}
