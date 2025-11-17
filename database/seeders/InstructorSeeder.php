<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $mails = ['Alice@gmail.com', 'Bob@yahoo.com', 'Charlie@gmail.com', 'Diana@gmail.com'];

        foreach($mails as $mail){
            Instructor::create([
                'email'=>$mail,
                'password'=>Hash::make('password123'),
            ]);
        }
    }
}
