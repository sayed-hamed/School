<?php

use App\Models\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();

        $bts=['O+','O-','AB+','AB-','A+','A-','B+','B-'];

        foreach ($bts as $bt){
            Blood::create([
                'name'=>$bt,
            ]);
        }
    }
}
