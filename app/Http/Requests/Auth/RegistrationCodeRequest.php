<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegistrationCodeRequest extends FormRequest
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
            'registration_code' => ['required', 'string', 'min:10', 'max:10'],
        ];
    }

    public function messages(): array 
    {
        return [
            'registration_code.required' => 'Privalote įvesti registracijos kodą',
            'registration_code.string' => 'Neteisingas registracijos kodo formatas',
            'registration_code.min:10' => 'Neteisingas registracijos kodo formatas',
            'registration_code.max:10' => 'Neteisingas registracijos kodo formatas',
        ];
    }
}
