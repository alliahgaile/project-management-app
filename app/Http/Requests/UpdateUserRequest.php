<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $user = $this->route("user");
        return [
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($user->id),
            ],
            "password" => [
                'nullable',
                'confirmed',
                Password::min(8)->letters()->symbols(),
            ],
        ];
    }
}
