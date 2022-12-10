<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $noFailMissingUser = true; // Used to trigger the validation error if required

        if (!$this->otherUser) // Can happend if the user field isn't required (edited in the DOM)
        {
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

        $noFailExistingUser = true; // Used to trigger the validation error if required
        if ($isExistingUser && !$existingUser) {
            $noFailExistingUser = null;
        }

        $imBorrower = array_key_exists('imBorrower', $this->all());

        $noFailUseExistingUserWhenBorrower = true; // Used to trigger the validation error if required
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
            // 'item' => ['required', 'exists:items,id'], // disabled because select isn't enabled
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
            'item.required' => "L'objet est requis.",
            'item.string' => "L'objet doit être une chaîne de caractères.",
            'item.exists' => "L'objet n'existe pas.",
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
