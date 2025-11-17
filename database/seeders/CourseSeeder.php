<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Course;
use App\Models\Partner;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $courseTitles = [
            'Business & Finance' => ['Business Analyst', 'Financial Planning', 'Startup Strategy'],
            'Music & Perform Arts' => ['Guitar for Beginners', 'Stage Performance', 'Music Theory'],
            'IT' => ['Laravel Fundamentals', 'Cybersecurity Basics', 'Cloud Computing'],
            'Art & Design' => ['Graphic Design', 'Illustration Techniques', 'Design Thinking'],
            'Language & Writing' => ['Creative Writing', 'English for Business', 'Japanese N5 Prep'],
            'Lifestyle & Development' => ['Time Management', 'Mindfulness Practice', 'Personal Growth'],
            'Cooking & Culinary' => ['Italian Cooking', 'Pastry Basics', 'Food Presentation'],
            'Professional Certification' => ['PMP Prep', 'Excel for Analysts', 'HR Certification'],
            'Health & Sports' => ['Fitness Fundamentals', 'Nutrition Basics', 'Yoga for Beginners'],
        ];

        $partnerToCategories = [
            1 => ['IT', 'Business & Finance', 'Professional Certification'], // Google
            4 => ['Art & Design'],                                            // Adobe
            5 => ['Cooking & Culinary'],                                      // LCB
            2 => ['Language & Writing', 'Lifestyle & Development'],           // EdX
        ];


        $instructors=collect([1,2,3,4]);

        $categories=Category::all();

        foreach($categories as $category){
            $titles= $courseTitles[$category->name];
            $possiblePartners = collect($partnerToCategories)
            ->filter(fn($cats) => in_array($category->name, $cats))
            ->keys();

            // random partner
            $partnerId = $possiblePartners->isNotEmpty()
            ? $possiblePartners->random()
            : Partner::inRandomOrder()->value('id');

            foreach($titles as $title){

                Course::create([
                    'title'=>$title,
                    'category_id'=>$category->id,
                    'partner_id'=>$partnerId,
                    'instructorID'=>$instructors->random(),
                    'price'=> rand(50000, 200000),
                    'thumbnail'=>null
                ]);
            }

        }

    }
}
