<?php

namespace App\Helpers\Traits;

trait IndexTrait{
    public function setKey($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['username']] = $item;
        }
        return $arr;
    }

    public function setKeyRank($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['id']] = $item;
        }
        return $arr;
    }
    public function setKeyDownlineUserRank($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['rank']['id']] = $item;
        }
        return $arr;
    }
}
