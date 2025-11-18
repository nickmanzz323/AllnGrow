<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\StudentDetail;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'email' => 'sarah.johnson@student.com',
                'password' => Hash::make('student123'),
                'detail' => [
                    'fullname' => 'Sarah Johnson',
                    'phone' => '+62823456789',
                    'gender' => 'female',
                    'dob' => '2002-07-25',
                    'country' => 'Indonesia',
                ]
            ],
            [
                'email' => 'david.lee@student.com',
                'password' => Hash::make('student123'),
                'detail' => [
                    'fullname' => 'David Lee',
                    'phone' => '+62823456790',
                    'gender' => 'male',
                    'dob' => '2001-11-12',
                    'country' => 'Indonesia',
                ]
            ],
            [
                'email' => 'emma.brown@student.com',
                'password' => Hash::make('student123'),
                'detail' => [
                    'fullname' => 'Emma Brown',
                    'phone' => '+62823456791',
                    'gender' => 'female',
                    'dob' => '2003-04-08',
                    'country' => 'Indonesia',
                ]
            ],
            [
                'email' => 'alex.garcia@student.com',
                'password' => Hash::make('student123'),
                'detail' => [
                    'fullname' => 'Alex Garcia',
                    'phone' => '+62823456792',
                    'gender' => 'male',
                    'dob' => '2002-01-30',
                    'country' => 'Indonesia',
                ]
            ],
        ];

        foreach($students as $studentData){
            $student = Student::firstOrCreate(
                ['email' => $studentData['email']],
                ['password' => $studentData['password']]
            );

            StudentDetail::updateOrCreate(
                ['studentID' => $student->id],
                $studentData['detail']
            );
        }

        echo "\nStudent accounts created:\n";
        echo "1. sarah.johnson@student.com / student123\n";
        echo "2. david.lee@student.com / student123\n";
        echo "3. emma.brown@student.com / student123\n";
        echo "4. alex.garcia@student.com / student123\n";
    }
}
