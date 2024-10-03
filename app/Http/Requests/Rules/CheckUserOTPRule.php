<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckUserOTPRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     public $email;
     public function __construct($email)
     {
         $this->email = $email;
     }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $this->email)->where('otp', $value)->first();
        if($user == false){
            $fail("Invalid User OTP! Please Try to valid OTP.");
        }

    }
}
