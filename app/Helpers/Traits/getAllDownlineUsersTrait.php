<?php

namespace App\Helpers\Traits;
use App\Models\User;

trait getAllDownlineUsersTrait{
    private function getAllDownlineUsers($user, $level, $maxLevel){
        if ($level > $maxLevel) {
            return [];
        }

        $referrals = User::where('refer', $user->username)->get();
        $userDetails = [];

        foreach ($referrals as $referral) {
            $referCount = User::where('refer', $referral->username)->count();

            $rank = [
                'id' => $referral->rank->rankInfo->id,
                'name' => $referral->rank->rankInfo->name,
            ];

            $userDetails[] = [
                'id' => $referral->id,
                'name' => $referral->name,
                'username' => $referral->username,
                'refer' => $referral->refer,
                'refer_count' => $referCount,
                'level' => $level,
                'rank' => $rank,
            ];
            $userDetails = array_merge($userDetails, $this->getAllDownlineUsers($referral, $level + 1, $maxLevel));
        }

        return $userDetails;
    }


    private function getAllDownlineOnlyUsernames($user, $level, $maxLevel){
        if ($level > $maxLevel) {
            return [];
        }

        $referrals = User::where('refer', $user->username)->get();
        $userDetails = [];

        foreach ($referrals as $referral) {
            $userDetails[] = [
                'id' => $referral->id,
                'name' => $referral->name,
                'username' => $referral->username,
                'refer' => $referral->refer,
            ];
            $userDetails = array_merge($userDetails, $this->getAllDownlineOnlyUsernames($referral, $level + 1, $maxLevel));
        }

        return $userDetails;
    }

    private function getAllDownlineOnlyUsernamesWithMe($user, $level, $maxLevel){
        $downlineUsernames = $this->getAllDownlineOnlyUsernames($user, $level, $maxLevel);
        $usernames = [];
        $usernames = [$user->username];
        foreach ($downlineUsernames as $dd) {
            $usernames[] = $dd['username'];
        }

        return $usernames ?? null;
    }

    private function getDownlineUserCount($user, $start_level, $end_level){
        $data = $this->getAllDownlineUsers($user, $start_level, $end_level);
        $rankCounts = [];
        foreach($data as $item){
            $rankId = 'designation_'.$item['rank']['id'];
            if (!isset($rankCounts[$rankId])) {
                $rankCounts[$rankId] = 0;
            }
            $rankCounts[$rankId]++;
        }
        return $rankCounts;
    }
}
