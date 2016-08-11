<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
            'user_id'       => 1,
            'name'          => 'Main Company',
            'is_active'     => true,
            'is_for_nse'    =>  true
        ]);


    }
}
