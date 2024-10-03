<?php

namespace App\Helpers\Traits;

use App\Models\User;

trait GetUserRankPITrait{
    public function getUplines2($username, $users) {
        $uplines = [];
        $user = $users[$username] ?? null;
        for ($i = 1; $i <= 12; $i++) {
            $user = $users[$user['refer']] ?? null;

            // Break the loop if there is no more referral data or user is null
            if ($user === null || !isset($user['refer'])) {
                break;
            }

            // $uplines[] = $user;
            $uplines[] = array_merge(['id' => $user['id'], 'username' => $user['username'], 'name' => $user['name'], 'refer' => $user['refer'], "rank_id" => $user['rank']['rank_id'], "rank_name" => $user['rank']['rank_name']]);
        }
        return $uplines;
    }

    public function setKey2($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['username']] = $item;
        }
        return $arr;
    }

    private function userPI($user){
        $users = $this->setKey2(User::all());
        $data = $this->getUplines2($user->username, $users);

        $result = 'no';
        foreach($data as $value){
            if($value['rank_id'] == 1){
                $dd = [
                    'name' => $value['name'],
                    'username' => $value['username'],
                ];
                return $dd;
            }
        }
        return $result;
    }

}
