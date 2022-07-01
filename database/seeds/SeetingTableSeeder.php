<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeetingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2022-2023'],
            ['key' => 'school_title', 'value' => 'SS'],
            ['key' => 'school_name', 'value' => 'GAD International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2022'],
            ['key' => 'end_second_term', 'value' => '01-03-2023'],
            ['key' => 'phone', 'value' => '01018621828'],
            ['key' => 'address', 'value' => 'دمرو'],
            ['key' => 'school_email', 'value' => 'info@gad.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}
