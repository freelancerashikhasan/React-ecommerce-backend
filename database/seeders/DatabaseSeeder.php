<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminSeeder::class);
        $this->call(CompanyInfo::class);
        $this->call(UserSeeder::class);
        // $this->call(RankSeeder::class);
        // $this->call(ClubBonusDetailsSeeder::class);
        // $this->call(ClubBonusDetailsAssetSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        // $this->call(NoticeSeeder::class);
        $this->call(socialSeeder::class);
        $this->call(genarelSettingseeder::class);
    }
}
