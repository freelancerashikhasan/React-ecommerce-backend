<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\genarelSetting;

class genarelSettingseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        genarelSetting::create(
            [
                'system_name' => 'System Name',
                'general_logo' => null,
                'white_logo' => null,
                'home_banner' => null,
                'favicon' => null,
                'company_name' => 'Company Name',
                'site_mettro' => 'Test Company Name',
                'meta_title' => 'Test Company Name',
                'meta_des' => 'Test Company Name',
                'meta_keywords' => 'Test Company Name',
                'created_at' => now()
            ]
        );




    }
}
