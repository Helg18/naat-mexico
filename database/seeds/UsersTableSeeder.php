<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Caffeinated\Shinobi\Models\Role;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*DB::table('users')->insert([
            'name' => 'Fernando Castillo',
            'email' => 'desarrollo@freengers.com',
            'password' => bcrypt('1234567890'),
        ]);*/

        $role_admin      = Role::where('slug','admin')->first();
        $role_executive  = Role::where('slug','executive')->first();
        $role_customer        = Role::where('slug','customer')->first();

        $admin = new User();
        $admin->name = 'Luis E. Flores';
        $admin->email = 'luis@kreativeco.com';
        $admin->password = bcrypt('1234567890');
        $admin->is_active= true;
        $admin->save();

        $admin->assignRole($role_admin->id);
        $admin->save();


        $executive = new User();
        $executive->name = 'Henry Leon';
        $executive->email = 'helg18@gmail.com';
        $executive->password = bcrypt('1234567890');
        $executive->is_active= true;
        $executive->save();

        $executive->assignRole($role_executive->id);
        $executive->save();
    }
}
