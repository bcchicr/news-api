<?php

namespace App\Http\Requests\User;

use App\DTO\User\RegisterUserDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function getDTO(): RegisterUserDTO
    {
        return new RegisterUserDTO(
            $this->get('name'),
            $this->get('email'),
            $this->get('password')
        );
    }
}
