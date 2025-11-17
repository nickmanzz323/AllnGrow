<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $partners = [
            ['name' => 'Google'],
            ['name' => 'EdX'],
            ['name' => 'ABRSM'],
            ['name' => 'Adobe'],
            ['name' => 'Le Cordon Bleu'],
            ['name' => 'Microsoft'],
            ['name' => 'Certification & Professional Skills'],
        ];

        foreach($partners as $p){
            Partner::create(['name'=>$p]);
        }
    }
}
