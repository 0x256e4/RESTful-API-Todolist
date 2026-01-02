<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            'name' => 'required|string|min:4',
            'email' => 'required|email|min:1',
            'password' => 'required|min:4'
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Field :attribute tidak boleh kurang dari :min! ^^',
            'email' => 'Field :attribute tidak boleh kosong',
            'password.min' => 'Field :attribute tidak boleh kurang dari :min! ^^'
        ];
    }
}
