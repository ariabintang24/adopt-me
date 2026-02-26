<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
            ]
        );


        $admin->assignRole('admin');
    }
}
