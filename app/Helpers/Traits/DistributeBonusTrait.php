<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\Rank;
use App\Models\Transaction;
use App\Models\User;

trait DistributeBonusTrait{
    use IndexTrait;

    public function getUplines($username, $users, $rankData) {
        $rankCount = count($rankData) ?? 0;
        $uplines = [];
        $user = $users[$username] ?? null;
        for ($i = 1; $i <= $rankCount; $i++) {
            $user = $users[$user['refer']] ?? null;

            // Break the loop if there is no more referral data or user is null
            if (($user === null) || (!isset($user['refer']))) {
                break;
            }

            // $uplines[] = $user;
            $uplines[] = array_merge(['id' => $user['id'], 'username' => $user['username'], 'name' => $user['name'], 'refer' => $user['refer'], "rank_id" => $user['rank']['rank_id'], "rank_name" => $user['rank']['rank_name']]);
        }
        return $uplines;
    }

    public function giveDistributionBonus($data, $usersData){
        $users = $this->setKey($usersData);
        $rankData = $this->setKeyRank(Rank::all());
        $rankCount = count($rankData) ?? 0;
        $uplines = $this->getUplines($data->user->username, $users, $rankData) ?? null;

        // return $uplines;

        $givable_commission = array_sum(array_column($rankData, 'commission'));

        $total_team_commission = 0;

        $uplineCounts = 0;
        foreach($uplines as $i => $upline){
            $uplineCounts++;
            if($uplineCounts <= $rankCount){
                if(($i != 0)){
                    if(($upline['username'] != 'orgalife')){
                        $total_team_commission += $rankData[$upline['rank_id']]['commission'] ?? 0;
                    }
                }
            }
        }

        // return $total_team_commission;

        $uplineCounts2 = 0;
        $result = [];
        $result2 = [];
        foreach($uplines as $kay => $upline){
            $uplineCounts2++;
            if($uplineCounts2 <= $rankCount){

                $team_commission_amount = $rankData[$upline['rank_id']]['commission'] ?? 0;
                $distributeable_commission = 0;
                if($kay == 0){
                    $distributeable_commission = ((($givable_commission - $total_team_commission) - $team_commission_amount) + $team_commission_amount);
                }
                else{
                    $distributeable_commission = $team_commission_amount;
                }

                if($data->type == Constant::ORDER_TYPE['customer']){
                    $transaction_note = $distributeable_commission.'% Commission from '.$data->user->name.' Purchase';
                    $transaction_type = Constant::TRANSACTION_TYPE['customer_order_commission'];
                }
                else if($data->type == Constant::ORDER_TYPE['pharmacy_a']){
                    $transaction_note = $distributeable_commission.'% Commission from '.$data->user->name.' Purchase';
                    $transaction_type = Constant::TRANSACTION_TYPE['pharmacy_order_commission'];
                }
                else if($data->type == Constant::ORDER_TYPE['pharmacy_b']){
                    $transaction_note = $distributeable_commission.'% Commission from '.$data->user->name.' Purchase';
                    $transaction_type = Constant::TRANSACTION_TYPE['pharmacy_order_commission'];
                }
                else if($data->type == Constant::ORDER_TYPE['pharmacy_c']){
                    $transaction_note = $distributeable_commission.'% Commission from '.$data->user->name.' Purchase';
                    $transaction_type = Constant::TRANSACTION_TYPE['pharmacy_order_commission'];
                }

                if(($upline['username'] != 'orgalife')){
                    $result = [
                        'transaction_note' => $transaction_note,
                        'commission' => $distributeable_commission,
                        'transaction_type' => $transaction_type,
                        'commission_amount' => (($data->total_point * $distributeable_commission) / 100) ?? 0,
                        'user' => $upline,
                    ];

                    $result2[] = $result;
                }

                if(($upline['username'] != 'orgalife')){
                    Transaction::create([
                        'user_id' => $users[$upline['username']]['id'],
                        'invoice_id' => $data->id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => $result['commission_amount'],
                        'cred_point' => 0,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_type' => $result['transaction_type'],
                        'transaction_note' => $result['transaction_note'],
                        'currency' => 'BDT',
                        'date' => time(),
                    ]);
                }

            }
        }

        return $result2;
    }

    // public function giveDistributionBonus2($data, $usersData){
    //     $users = $this->setKey($usersData);
    //     $rankData = $this->setKeyRank(Rank::all());
    //     $uplines = $this->getUplines($data->username, $users) ?? null;

    //     $givable_with_trade_license_commission = array_sum(array_column($rankData, 'commission'));
    //     $givable_without_trade_license_commission = array_sum(array_column($rankData, 'commission1'));

    //     $total_team_with_trade_license_commission = 0;
    //     $total_team_givable_without_trade_license_commission = 0;


    //     $uplineCounts = 0;
    //     foreach($uplines as $i => $upline){
    //         $uplineCounts++;
    //         if($uplineCounts < 6){
    //             if($data->type == Constant::MERCHANT_DATA_TYPE['with_trade_license']){
    //                 $total_team_with_trade_license_commission += $rankData[$upline['rank_id']]['commission'] ?? 0;
    //             }
    //             else if($data->type == Constant::MERCHANT_DATA_TYPE['without_trade_license']){
    //                 $total_team_givable_without_trade_license_commission += $rankData[$upline['rank_id']]['commission1'] ?? 0;
    //             }
    //         }

    //     }


    //     if($data->type == Constant::MERCHANT_DATA_TYPE['with_trade_license']){
    //         $commission_amount = $rankData[$users[$data->username]['rank']['rank_id']]['commission'] ?? 0;
    //         $transaction_type = Constant::TRANSACTION_TYPE['self_entry_commission'];
    //         $transaction_note = 'Personal With Trade License Merchent Data Entry To entry id '.$data->id;

    //         $self_commission = ((($givable_with_trade_license_commission - $total_team_with_trade_license_commission) - $commission_amount) + $commission_amount);
    //     }
    //     else if($data->type == Constant::MERCHANT_DATA_TYPE['without_trade_license']){
    //         $commission_amount = $rankData[$users[$data->username]['rank']['rank_id']]['commission1'] ?? 0;
    //         $transaction_type = Constant::TRANSACTION_TYPE['self_entry_commission'];
    //         $transaction_note = 'Personal Without Trade License Merchent Data Entry To entry id '.$data->id;

    //         $self_commission = ((($givable_without_trade_license_commission - $total_team_givable_without_trade_license_commission) - $commission_amount) + $commission_amount);
    //     }
    //     else{
    //         return false;
    //     }

    //     Transaction::create([
    //         'user_id' => $users[$data->username]['id'],
    //         'invoice_id' => $data->id,
    //         'wallet_type' => Constant::WALLET_TYPE['active_balance'],
    //         'deb_amount' => 0,
    //         'cred_amount' => $self_commission,
    //         'cred_point' => 0,
    //         'deb_point' => 0,
    //         'status' => Constant::STATUS['approved'],
    //         'in_status' => Constant::IN_STATUS['active'],
    //         'transaction_type' => $transaction_type,
    //         'transaction_note' => $transaction_note,
    //         'currency' => 'BDT',
    //         'date' => time(),
    //     ]);

    //     $uplineCounts2 = 0;
    //     foreach($uplines as $upline){
    //         $uplineCounts2++;

    //         if($uplineCounts2 < 6){
    //             if($data->type == Constant::MERCHANT_DATA_TYPE['with_trade_license']){
    //                 $team_commission_amount = $rankData[$upline['rank_id']]['commission'] ?? 0;
    //                 $transaction_type = Constant::TRANSACTION_TYPE['group_entry_commission'];
    //                 $transaction_note = 'Group With Trade License Merchent Data Entry To entry id '.$data->id;
    //             }
    //             else if($data->type == Constant::MERCHANT_DATA_TYPE['without_trade_license']){
    //                 $team_commission_amount = $rankData[$upline['rank_id']]['commission1'] ?? 0;
    //                 $transaction_type = Constant::TRANSACTION_TYPE['group_entry_commission'];
    //                 $transaction_note = 'Group Without Trade License Merchent Data Entry To entry id '.$data->id;
    //             }

    //             Transaction::create([
    //                 'user_id' => $users[$upline['username']]['id'],
    //                 'invoice_id' => $data->id,
    //                 'wallet_type' => Constant::WALLET_TYPE['active_balance'],
    //                 'deb_amount' => 0,
    //                 'cred_amount' => $team_commission_amount,
    //                 'cred_point' => 0,
    //                 'deb_point' => 0,
    //                 'status' => Constant::STATUS['approved'],
    //                 'in_status' => Constant::IN_STATUS['active'],
    //                 'transaction_type' => $transaction_type,
    //                 'transaction_note' => $transaction_note,
    //                 'currency' => 'BDT',
    //                 'date' => time(),
    //             ]);
    //         }
    //     }

    //     return true;
    // }
}
