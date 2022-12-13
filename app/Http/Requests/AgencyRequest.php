<?php

namespace App\Http\Requests;

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AgencyRequest extends FormRequest
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
            "name"=>"required|min:3|max:15|string",
            "headquarters"=>"required|min:5|max:12",
            'logo'=>"required|mimes:png,jpg,jpeg",
            'phone_number'=>"required|max:20",
            'email'=>"required|email|unique:agencies,email",
            'password'=>"required|min:8"
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'data'      => $validator->errors()
       ],400));
    }
}
