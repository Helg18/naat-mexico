<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Número de cuartos o habitaciones'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Tipo de piso'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Numero de baños'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Regadera'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Estufa de gas'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Número de focos'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Número de automóviles'
        ]);

        DB::table('questions')->insert([
            'quiz_id'   =>  1,
            'type'      =>  'Opcion Unica',
            'question'  =>  'Escolaridad de la persona que más aporta'
        ]);

    }
}
