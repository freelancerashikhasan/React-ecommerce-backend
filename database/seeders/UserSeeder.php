<?php
namespace Database\Seeders;

use App\Helpers\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::insert(
            [
                [
                    'name' => 'user',
                    'username' => 'user',
                    'phone' => '123456789',
                    'email' => 'user@mail.com',
                    'gender' => Constant::GENDER['male'],
                    'country' => '1',
                    'states' => '1',
                    'division_id' => '7',
                    'district_id' => '53',
                    'upazila_id' => '400',
                    'union_id' => '3659',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'),
                    'show_password' => '12345678',
                    'status' => Constant::USER_STATUS['active'],
                    'type' => Constant::USER_TYPE['customer'],
                    'created_at' => now()
                ],
                // [
                //     'name' => 'Baranch',
                //     'username' => 'branch',
                //     'phone' => '123456789',
                //     'refer' => 'user',
                //     'agent' => null,
                //     'email' => 'branch@mail.com',
                //     'nid_no' => '123456',
                //     'gender' => Constant::GENDER['male'],
                //     'birthday' => '654912000',
                //     'country' => '1',
                //     'states' => '1',
                //     'division_id' => '7',
                //     'district_id' => '53',
                //     'upazila_id' => '400',
                //     'union_id' => '3659',
                //     'village_id' => '1',
                //     'email_verified_at' => now(),
                //     'password' => Hash::make('12345678'),
                //     'show_password' => '12345678',
                //     'status' => Constant::USER_STATUS['active'],
                //     'type' => Constant::USER_TYPE['agent'],
                //     'created_at' => now()
                // ]
            ]
        );
    }
}
