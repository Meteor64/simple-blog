<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'string', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'mobile' => ['required', 'max:255', 'string', Rule::unique('users', 'mobile')->ignore($user->id)],
            'role' => ['required', 'max:255', 'string']
        ];
    }
}
