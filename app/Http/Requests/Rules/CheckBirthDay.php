<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckBirthDay implements ValidationRule
{

    public $user_type;
    function __construct($user_type){
        $this->user_type = $user_type;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if($this->user_type != Constant::USER_TYPE['agent']){
            $birthdate = Carbon::createFromFormat('d-m-Y', $value);
            $currentDate = Carbon::now();
            $age = $birthdate->diffInYears($currentDate);

            if($age <= Constant::MIN_YEAR['old']){
                $fail("Minimum ". Constant::MIN_YEAR['old'] . " Years Old Required.");
            }
        }
    }
}
