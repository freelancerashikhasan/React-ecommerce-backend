<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckOldPasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();
        if(!Hash::check($value, $user->password)){
            $fail("The old password is incorrect.");
        }


    }
}
