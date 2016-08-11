<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('quizzes')->insert([
            'company_id'    => 1,
            'name'          =>  'Completa tu perfil para que podamos personalizar mejor tus cuentas.',
            'is_active'     =>  true,
            'points'        =>  30
            //'nse_level'    =>  0
        ]);


    }
}
