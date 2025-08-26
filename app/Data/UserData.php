<?php

namespace App\Data;

use App\Models\User;
use Illuminate\Validation\Rules;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class UserData extends Data
{
    public function __construct(
        #[Required, StringType, Min(3), Max(200)]
        public string $name,

        public string $email,

        public string $password,
    ) {}

    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:200', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public static function authorize(): bool
    {
        return true;
    }
}
