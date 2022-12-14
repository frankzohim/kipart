<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PathRequest extends FormRequest
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
            "departure"=>"required",
            "arrival"=>"required",
            "state"=>"required"
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
            'departure' => 'le champs depart est requis',
            'arrival.required' => 'le champs arrivé est requis',
            'state.required' => 'le champs Etat est requis',
        ];
    }
}
