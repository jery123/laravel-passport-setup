<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:5|max:20',
        ];
    }

    /**
     * Function: failedValidation
     * @paramm Validator
     * @param Exception
     */
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => "Validation failed",
                'error' => $validator->errors(),
            ], 422)
            );
    }
}
