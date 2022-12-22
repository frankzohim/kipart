<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PassengerRequest extends FormRequest
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
            'name'=>'required',
            'type'=>'required',
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
            'name.required' => 'le champs nom est requis',
            'type.required' => 'le champs type est requis',
            'seatNumber.required' => 'le champs numero de place est requis',
            'cni.numeric' => 'Votre numero de cni doit contenir que des chiffres',
            'cni.min' => 'votre cni doit contenir 9 chiffres',
            'cni.max' => 'votre cni doit contenir 9 chiffres'
        ];
    }
}
