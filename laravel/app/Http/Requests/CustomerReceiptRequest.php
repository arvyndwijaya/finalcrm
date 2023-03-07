<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerReceiptRequest extends FormRequest
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
        return [
            'customerReceiptName'          => 'required|max:150',
            'customerId'                   => 'required',
            'customerReceiptSpherisRight'  => 'required|max:10',
            'customerReceiptSpherisLeft'   => 'required|max:10',
            'customerReceiptCylinderRight' => 'required|max:10',
            'customerReceiptCylinderLeft'  => 'required|max:10',
            'customerReceiptAdditionRight' => 'required|max:10',
            'customerReceiptAdditionLeft'  => 'required|max:10',
            'customerReceiptAxisRight'     => 'required|max:10',
            'customerReceiptAxisLeft'      => 'required|max:10',
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
