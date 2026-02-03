<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'sitename'          => 'Assignment',
                'email'             => 'info@example.com',
                'phone'             => '+91-1234567890',
                'short_description' => 'This is a short description of my website.',
                'header_logo'       => 'header-logo.png',
                'footer_logo'       => 'footer-logo.png',
                'fav_icon'          => 'favicon.ico',
            ]
        );
    }
}
