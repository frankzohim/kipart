<?php

namespace App\Http\Requests\Otp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ResetPasswordRequest extends FormRequest
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
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6',
            'phone_number'=>'required|string|exists:users'
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json(
         $validator->errors()
       ,400));
    }


    public function messages()
    {
        return [
            'code.required' => 'le champs code est requis',
            'phone_number.required' => 'le champs numero de telephone est requis',
            'password.required' => 'le champs mot de passe est requis',
        ];
    }
}
