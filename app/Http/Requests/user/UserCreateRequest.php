<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            //
            'name' => 'required|string|max:255',
            'is_active'   =>'required|boolean',
            'username' => 'required|string|max:255',
            'type' => 'required|in:normal,gold,silver',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed', // Minimum password length is 8
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ];
    }
}
