<?php

namespace App\Actions\Fortify;

use App\Models\Representative;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Contracts\CreatesNewRepresentatives;

class CreateNewRepresentative implements CreatesNewRepresentatives
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered representative.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Representative
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Representative::class),
            ],
            'password' => ['required'],
        ])->validate();

        return Representative::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
