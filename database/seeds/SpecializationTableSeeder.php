<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spacializations')->delete();

        $specials=[
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
            ['en'=> 'physics', 'ar'=> 'فيزياء'],
            ['en'=> 'chemistry', 'ar'=> 'كيمياء'],
        ];

        foreach ($specials as $spec){
            \App\Models\Spacialization::create([
                'name'=>$spec,
            ]);
        }
    }
}
