<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $genders=[
            ['en'=>'Male','ar'=>'ذكر'],
            ['en'=>'FeMale','ar'=>'انثي'],

        ];

        foreach ($genders as $gender){
            \App\Models\Gender::create([
               'name'=>$gender,
            ]);
        }
    }
}
