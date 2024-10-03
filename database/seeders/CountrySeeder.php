<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Country::create(
            [
                'name' => 'Bangladesh',
                'currency_name' => 'BDT',
                'currency_symbol' => '৳',
                'timezone' => 'Asia/Dhaka',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );


    }
}
