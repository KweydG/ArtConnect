<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@artconnect.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'bio' => 'Administrator of ArtConnect platform.',
            'role' => 'admin',
        ]);

        // Create demo artist users
        $artists = [
            [
                'name' => 'Maria Santos',
                'email' => 'maria@artconnect.com',
                'bio' => 'Digital artist and illustrator from Manila. Passionate about creating vibrant and colorful artworks.',
                'location' => 'Manila, Philippines',
            ],
            [
                'name' => 'Juan dela Cruz',
                'email' => 'juan@artconnect.com',
                'bio' => 'Traditional painter specializing in oil and watercolor landscapes.',
                'location' => 'Cebu, Philippines',
            ],
            [
                'name' => 'Ana Reyes',
                'email' => 'ana@artconnect.com',
                'bio' => 'Photographer capturing the beauty of urban life and nature.',
                'location' => 'Davao, Philippines',
            ],
        ];

        foreach ($artists as $artist) {
            User::create([
                'name' => $artist['name'],
                'email' => $artist['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'bio' => $artist['bio'],
                'location' => $artist['location'],
                'role' => 'user',
            ]);
        }

        // Create additional random users
        User::factory(10)->create();
    }
}
