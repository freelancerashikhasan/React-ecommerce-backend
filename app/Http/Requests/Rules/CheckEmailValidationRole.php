<?php

namespace App\Http\Requests\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Helpers\Constant;
use App\Models\User;
use Auth;
class CheckEmailValidationRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dd = ['gmail.com', 'yahoo.com'];
        $ext = explode('@', $value);
        if(in_array($ext[1], $dd) != true){
            $fail('Invalid Email Address! Please Enter Valid Email Address.');
        }
    }
}
