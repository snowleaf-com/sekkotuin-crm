<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'last_name' => ['required', 'max:50'],
            'first_name' => ['required', 'max:50'],
            'last_name_kana' => ['required', 'regex:/^[ァ-ヾ]+$/u', 'max:50'],
            'first_name_kana' => ['required', 'regex:/^[ァ-ヾ]+$/u', 'max:50'],
            'postcode' => ['required', 'max:7'],
            'address' => ['required', 'max:100'],
            'tel' => ['required', 'max:20'],
            'birth' => ['required', 'date'],
            'gender' => ['required'],
            'memo' => ['max:1000'],
        ];
    }
}
