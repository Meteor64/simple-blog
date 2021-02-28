<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $password;

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
    public function rules()
    {
        return [
            'profile_img' => ['nullable', 'image', 'max:2024'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11',
                Rule::unique('users', 'mobile')->ignore($this->user())],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->user())],
            'password' => ['nullable', 'min:6'],
        ];
    }
}
