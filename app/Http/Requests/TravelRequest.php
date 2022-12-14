<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TravelRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;


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
            'date'=>"required",
            'path_id'=>"required",
            'classe'=>"required",
            'price'=>"required",
            "type"=>"required",
            'departure_time'=>"required",
            'state'=>"required"
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
            'date.required' => 'le champs date est requis',
            'path_id.required' => 'le champs Trajet est requis',
            'classe.required' => 'le champs classe est requis',
            'price.required' => 'le champs prix est requis',
            'state.required' => 'le champs Etat est requis',
            'type.required' => 'le champs Type est requis',
            'departure_time.required' => 'le champs heure de depart est requis'
        ];
    }

}
