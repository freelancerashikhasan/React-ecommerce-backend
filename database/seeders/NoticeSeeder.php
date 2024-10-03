<?php

namespace Database\Seeders;
use App\Models\Notice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $notices = [
            [
                'notice_img' => 'image1.jpg',
                'notice_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            [
                'notice_img' => 'image2.jpg',
                'notice_text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            // Add more sample data as needed
        ];

        // Loop through the sample data and create notices
        foreach ($notices as $notice) {
            Notice::create($notice);
        }






    }
}
