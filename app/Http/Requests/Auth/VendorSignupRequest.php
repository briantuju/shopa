<?php

namespace App\Http\Requests\Auth;

use App\Enums\BusinessType;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class VendorSignupRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal details
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Business details
            'business_name' => ['required', 'string', 'max:200'],
            'business_type' => ['required', 'string', Rule::in(BusinessType::cases())],
            'store_name' => ['required', 'string', 'max:200'],
            'address_line' => ['required', 'string', 'max:200'],
        ];
    }
}
