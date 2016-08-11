<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        DB::table('permissions')->insert([
            'name' => 'companies.access',
            'slug' => 'companies.access',
            'description'   =>  'Dar de alta empresas'
        ]);

        DB::table('permissions')->insert([
            'name' => 'companies.all',
            'slug' => 'companies.all',
            'description'   =>  'Leer todas las empresas incluso las que no pertenecen al propio usuario'
        ]);

        DB::table('permissions')->insert([
            'name' => 'company.access',
            'slug' => 'company.access',
            'description'   =>  'Actividades de usuario final'
        ]);

        DB::table('permissions')->insert([
            'name' => 'config.access',
            'slug' => 'config.access',
            'description'   =>  'Catalogos, todos los usuarios, etc'
        ]);

        DB::table('permissions')->insert([
            'name' => 'nse.access',
            'slug' => 'nse.access',
            'description'   =>  'Acceso a la configuración de nivel socioeconomico'
        ]);

        DB::table('permissions')->insert([
            'name' => 'report.access',
            'slug' => 'report.access',
            'description'   =>  'Acceso reportes'
        ]);

    }
}
