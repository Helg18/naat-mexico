<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class NseLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nse_levels')->insert([
            'name'  => 'E',
            'min'   => 0,
            'max'   => 32
        ]);

        DB::table('nse_levels')->insert([
            'name'  => 'D',
            'min'   => 33,
            'max'   => 79
        ]);

        DB::table('nse_levels')->insert([
            'name'  => 'D+',
            'min'   => 80,
            'max'   => 104
        ]);

        DB::table('nse_levels')->insert([
            'name'  => 'C-',
            'min'   => 105,
            'max'   => 127
        ]);

        DB::table('nse_levels')->insert([
            'name'  => 'C',
            'min'   => 128,
            'max'   => 154
        ]);
        DB::table('nse_levels')->insert([
            'name'  => 'C+',
            'min'   => 155,
            'max'   => 192
        ]);
        DB::table('nse_levels')->insert([
            'name'  => 'AB',
            'min'   => 193,
            'max'   => 99999999
        ]);

    }
}
