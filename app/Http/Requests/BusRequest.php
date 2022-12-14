<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BusRequest extends FormRequest
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
        'registration'=>"required",
        'number_of_places'=>"required",
        'plan'=>"required",
        'classe'=>"required"
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         $validator->errors()
       ],400));
    }


    public function messages()
    {
        return [
            'registration.required' => 'le champs immatriculation est requis',
            'number_of_places.required' => 'le champs nombre de places est requis',
            'classe.required' => 'le champs classe est requis',
            'plan.required' => 'le champs plan est requis',
        ];
    }
}
