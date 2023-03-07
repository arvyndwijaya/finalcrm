<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
    */
    public function rules(): array
    {
        if ($this->route()->getName() === 'customers.update') {
            return [
                'customerName'        => 'required|max:150',
                'customerBirthDate'   => 'required',
                'customerAddress'     => 'required',
                'customerCity'        => 'required|max:40',
                'customerNoHandphone' => 'required|max:20',
            ];
        }

        return [
            'customerName'        => 'required|max:150',
            'customerBirthDate'   => 'required',
            'customerAddress'     => 'required',
            'customerCity'        => 'required|max:40',
            'customerNoHandphone' => 'required|max:20',
            'customerEmail'       => 'required|unique:customers,email|email:rfc.dns|max:100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'customerEmail.unique' => "Email {$this->input('customerEmail')} sudah terdaftar",
        ];
    }

    /**
     * Override the failedVaildation to a new response format when validation failed.
    */
    protected function failedValidation(Validator $validator): object
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'request' => $this->input(),
            ], 422)
        );
    }
}
