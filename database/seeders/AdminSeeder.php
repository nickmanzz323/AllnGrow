<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default jika belum ada
        Admin::firstOrCreate(
            ['email' => 'admin@allngrow.com'],
            [
                'password' => Hash::make('admin123'),
            ]
        );

        echo "Admin account created:\n";
        echo "Email: admin@allngrow.com\n";
        echo "Password: admin123\n";
    }
}
