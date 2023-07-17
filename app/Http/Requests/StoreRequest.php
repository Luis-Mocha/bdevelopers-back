<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|max:30',
            'surname' => 'required|max:40',
            'birth_date' => 'required|date|before:2023-01-01',
            'phone_number' => 'nullable|unique:profiles|numeric|regex:/^[0-9]{8,13}$/',
            'email' => 'required|email|unique:profiles,email',
            'github_url' => 'required|unique:profiles|url',
            'linkedin_url' => 'required|unique:profiles|required|url',
            'profile_image' => 'required|mimes:jpeg,png,jpg,gif|max:10240',
            'curriculum' => 'required|mimes:pdf|max:5120',
            'performance' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il campo "nome" è obbligatorio',
            'surname.required' => 'Il campo "cognome" è obbligatorio',
            'birth_date.required' => 'Il campo "data di nascita" è obbligatorio',
            'email.required' => 'Il campo "email" è obbligatorio',
            'github_url.required' => 'Il campo "github" è obbligatorio',
            'linkedin_url.required' => 'Il campo "linkedin" è obbligatorio',
            'profile_image.required' => 'Il campo "immagine" è obbligatorio',
            'curriculum.required' => 'Il campo "curriculum" è obbligatorio',
            'performance.required' => 'Il campo "performance" è obbligatorio',

            'phone_number.unique' => 'Questo numero è gia utilizzato da un altro utente',
            'github_url.unique' => 'Questo link github è già utilizzato da un altro utente',
            'linkedin_url.unique' => 'Questo link linkedin è già utilizzato da un altro utente',

            'profile_image.image' => 'Il file deve essere di tipo immagine',

            'github_url.url' => 'Questo campo deve contenere un link URL valido ',
            'linkedin_url.url' => 'Questo campo deve contenere un link URL valido ',

            'profile_image.mimes' => 'Il file deve essere formato jpeg, png, jpg, gif',
            'curriculum.mimes' => 'Il file deve essere formato pdf',

            'name.max' => 'Il nome non deve superare i 30 caratteri',
            'surname.max' => 'Il cognome non deve superare i 40 caratteri',
            'profile_image.max' => "La dimensione dell'immagine non deve superare i 10MB",
            'curriculum.max' => "La dimensione del curriculum non deve superare i 5MB",

            'birth_date.date' => 'Inserisci una data',
            'birth_date.before' => 'Inserisci una data valida',

            'phone_number.numeric' => 'Il campo deve contenere numeri',

            'phone_number.regex' => 'Il numero deve essere compreso tra 8 e 13 cifre',
        ];
    }
}
