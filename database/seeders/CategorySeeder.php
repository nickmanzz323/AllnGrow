<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Business & Finance',
            'Music & Perform Arts',
            'IT',
            'Art & Design',
            'Language & Writing',
            'Lifestyle & Development',
            'Cooking & Culinary',
            'Professional Certification',
            'Health & Sports',
        ];

        foreach($categories as $name){
            Category::create(['name'=>$name]);
        }
        
    }
}
