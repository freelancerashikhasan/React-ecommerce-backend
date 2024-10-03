<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\MerchantDataEntry;

trait DataCalculationTrait{
    use getAllDownlineUsersTrait;

    private function withTotalDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['with_trade_license'])->whereIn('username', $usernames);

        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

    private function withoutTotalDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['without_trade_license'])->whereIn('username', $usernames);

        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

    private function withApprovedDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['with_trade_license'])->where('status', Constant::STATUS['approved'])->whereIn('username', $usernames);

        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

    private function withoutApprovedDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['without_trade_license'])->where('status', Constant::STATUS['approved'])->whereIn('username', $usernames);

        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

    private function withPendingDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['with_trade_license'])->where('status', Constant::STATUS['pending'])->whereIn('username', $usernames);

        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

    private function withoutPendingDataCount($usernames, $form_date = null, $to_date = null){
        $data = MerchantDataEntry::where('type', Constant::MERCHANT_DATA_TYPE['without_trade_license'])->where('status', Constant::STATUS['pending'])->whereIn('username', $usernames);


        if(($form_date != null) && ($to_date != null)){
            $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
        }
        else{
            if($form_date != null){
                $data = $data->whereBetween('date',[strtotime($form_date. ' 00:00:01'), strtotime($form_date. ' 23:59:59')]);
            }
            else if($to_date != null){
                $data = $data->whereBetween('date',[strtotime($to_date. ' 00:00:01'), strtotime($to_date. ' 23:59:59')]);
            }
            else{
                $data = $data;
            }
        }

        return $data->get()->count() ?? 0;
    }

}
