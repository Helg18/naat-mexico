<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('plans')->insert([
            'name'              => 'Plan A',
            'limit_user'        => '10',
            'limit_quiz'        => '10',
            'days_expiration'   => '100',
            'price'             => '5000',
            'is_active'         => true,
        ]);

        DB::table('plans')->insert([
            'name'              => 'Plan B',
            'limit_user'        => '30',
            'limit_quiz'        => '30',
            'days_expiration'   => '200',
            'price'             => '10000',
            'is_active'         => true,
        ]);
    }
}
