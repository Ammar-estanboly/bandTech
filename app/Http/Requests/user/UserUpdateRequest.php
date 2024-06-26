<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UserUpdateRequest extends FormRequest
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
            'name' => 'string|max:255',
            'is_active'   =>'boolean',
            'username' => 'string|max:255',
            'type' => 'in:normal,gold,silver',
            'email'         => [ 'string', 'email', 'max:255', 'unique:users,email,'. $this->user->id],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ];
    }
}
