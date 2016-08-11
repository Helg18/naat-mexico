<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'slug' => 'admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'Ejecutivo',
            'slug' => 'executive',
        ]);

        DB::table('roles')->insert([
            'name' => 'Cliente',
            'slug' => 'customer',
        ]);

        DB::table('roles')->insert([
            'name' => 'Encuestado',
            'slug' => 'survey_respondent',
        ]);
    }
}
