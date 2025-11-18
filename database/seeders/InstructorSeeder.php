<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;
use App\Models\InstructorDetail;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = [
            [
                'email' => 'john.doe@instructor.com',
                'password' => Hash::make('instructor123'),
                'detail' => [
                    'fullname' => 'John Doe',
                    'phone' => '+62812345678',
                    'gender' => 'male',
                    'dob' => '1990-05-15',
                    'bio' => 'Experienced web developer with 10+ years in the industry.',
                    'country' => 'Indonesia',
                    'expertise' => 'Web Development, Laravel, Vue.js',
                    'yearsOfExperience' => 10,
                    'linkedin' => 'https://linkedin.com/in/johndoe',
                    'status' => 'approved',
                ]
            ],
            [
                'email' => 'jane.smith@instructor.com',
                'password' => Hash::make('instructor123'),
                'detail' => [
                    'fullname' => 'Jane Smith',
                    'phone' => '+62812345679',
                    'gender' => 'female',
                    'dob' => '1988-08-20',
                    'bio' => 'UI/UX Designer passionate about creating beautiful user experiences.',
                    'country' => 'Indonesia',
                    'expertise' => 'UI/UX Design, Figma, Adobe XD',
                    'yearsOfExperience' => 8,
                    'linkedin' => 'https://linkedin.com/in/janesmith',
                    'status' => 'approved',
                ]
            ],
            [
                'email' => 'mike.wilson@instructor.com',
                'password' => Hash::make('instructor123'),
                'detail' => [
                    'fullname' => 'Mike Wilson',
                    'phone' => '+62812345680',
                    'gender' => 'male',
                    'dob' => '1992-03-10',
                    'bio' => 'Data Science expert specializing in machine learning and AI.',
                    'country' => 'Indonesia',
                    'expertise' => 'Data Science, Python, Machine Learning',
                    'yearsOfExperience' => 6,
                    'linkedin' => 'https://linkedin.com/in/mikewilson',
                    'status' => 'pending',
                ]
            ],
        ];

        foreach($instructors as $instructorData){
            $instructor = Instructor::firstOrCreate(
                ['email' => $instructorData['email']],
                ['password' => $instructorData['password']]
            );

            InstructorDetail::updateOrCreate(
                ['instructorID' => $instructor->id],
                $instructorData['detail']
            );
        }

        echo "\nInstructor accounts created:\n";
        echo "1. john.doe@instructor.com / instructor123 (Approved)\n";
        echo "2. jane.smith@instructor.com / instructor123 (Approved)\n";
        echo "3. mike.wilson@instructor.com / instructor123 (Pending)\n";
    }
}
