<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Helpers\Traits\Balance;
use App\Models\ComapanyInfo;
use App\Models\User;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class WithdrawAmountCheckRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $config = ComapanyInfo::findOrFail(1);
        $balance = Balance::available_balance();

        if($value == 0){
            $fail(" Invalid amount! ");
        }
        else{
            if($value < $config->min_withdraw){
                $fail(" Invalid amount! Minumum withdraw amount ".$config->min_withdraw.' '. auth()->user()->countryInfo->currency_name);
            }
            if($value > $balance){
                $fail(" Insufficient Balance! You have ".number_format($balance, 2)." ".auth()->user()->countryInfo->currency_name."  in your account");
            }
            if($config->max_withdraw != null){
                if($value > $config->max_withdraw){
                    $fail(" Your are cross the maximum withdraw limit!");
                }
            }
        }

    }
}
