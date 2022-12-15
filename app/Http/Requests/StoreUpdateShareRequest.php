<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StoreUpdateShareRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Vars used to trigger the validation error if required (will be null if there is an error)
        $noFailMissingUser = true;
        $noFailExistingUser = true;
        $noFailUseExistingUserWhenBorrower = true;

        // Validations

        // Can happend if the user field isn't required (edited in the DOM)
        if (!$this->otherUser) {
            $noFailMissingUser = null;
            $isExistingUser = false;
            $otherUserName = null;
        } else {
            $isExistingUser = $this->otherUser[0] === '@';
            $otherUserName = $this->otherUser;
        }


        $existingUser = null;
        if ($isExistingUser) {
            $otherUserName = substr($otherUserName, 1);
            $existingUser = User::where('name', $otherUserName)->first();
        }

        if ($isExistingUser && !$existingUser) {
            $noFailExistingUser = null;
        }

        $imBorrower = array_key_exists('imBorrower', $this->all());

        if ($imBorrower && $isExistingUser) {
            $noFailUseExistingUserWhenBorrower = null;
        }

        $this->merge([
            'imBorrower' => $imBorrower,
            'terminated' => array_key_exists('terminated', $this->all()),
            'isExistingUser' => $isExistingUser,
            'existingUser' => $existingUser,
            'otherUserName' => $otherUserName,
            'noFailExistingUser' => $noFailExistingUser,
            'noFailMissingUser' => $noFailMissingUser,
            'noFailUseExistingUserWhenBorrower' => $noFailUseExistingUserWhenBorrower,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'itemId' => ['required', 'integer', 'exists:items,id'],
            'imBorrower' => ['required', 'boolean'],
            'since' => ['required', 'date'],
            'deadline' => ['nullable', 'date'],
            'terminated' => ['required', 'boolean'],
            'isExistingUser' => ['boolean'],
            'existingUser' => ['nullable'],
            'otherUserName' => ['nullable', 'string', 'max:255'],
            'noFailExistingUser' => ['required', 'boolean'],
            'noFailMissingUser' => ['required', 'boolean'],
            'noFailUseExistingUserWhenBorrower' => ['required', 'boolean'],
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
            'itemId.required' => "L'objet est requis.",
            'itemId.integer' => "L'ID de l'objet doit être un entier.",
            'itemId.exists' => "L'objet n'existe pas.",
            'otherUserName.string' => "Le nom de la personne doit être une chaîne de caractères.",
            'otherUserName.max' => "Le nom pour la personne est trop long.",
            'since.required' => "La date de début est requise.",
            'since.date' => "La date de début n'est pas valide",
            'deadline.date' => "La date de fin  n'est pas valide",
            'noFailExistingUser' => "Le nom saisi ne correspond à aucun utilisateur.",
            'noFailMissingUser' => "Le nom de la personne est requis.",
            'noFailUseExistingUserWhenBorrower' => "Vous ne pouvez pas sélectionner un utilisateur existant lorsque vous êtes emprunteur.",
        ];
    }
}
