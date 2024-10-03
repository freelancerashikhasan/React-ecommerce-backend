<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        State::create(
            [
                'name' => 'Dhaka',
                'postal_code' => '1200',
                'tele_code' => '+88',
                'country_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );


    }
}
