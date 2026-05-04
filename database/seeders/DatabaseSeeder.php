<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@alostora.com',
                'password' => Hash::make('Admin@12345'),
            ]
        );

        $this->call([
            ServiceSeeder::class,
            OfferSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            BlogSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
