<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\ComapanyInfo;
use App\Models\User;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AmountCheckRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $config = ComapanyInfo::findOrFail(1);

        if($value < $config->min_deposit){
            $fail("Invalid amount! Minumum deposit amount 100 ". auth()->user()->countryInfo->currency_name . ".");
        }
        if($config->max_deposit != null){
            if($value > $config->max_deposit){
                $fail(" Your are cross the maximum deposit limit!");
            }
        }
    }
}
