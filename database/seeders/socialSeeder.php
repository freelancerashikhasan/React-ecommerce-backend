<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Socials;
class socialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Socials::create(
            [
                'facebook' => null,
                'instagram' => null,
                'linkedin' => null,
                'x' => null,
                'email' => null,
                'phone' => null,
            ]
        );
    }
}
