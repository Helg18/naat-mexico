<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Roles
        $admin      = Role::where('slug','admin')->first();
        $executive  = Role::where('slug','executive')->first();
        $customer    = Role::where('slug','customer')->first();


        //Permissions
        $company   = Permission::where('slug','company.access')->first();
        $config    = Permission::where('slug','config.access')->first();
        $companies   = Permission::where('slug','companies.access')->first();
        $companiesAll   = Permission::where('slug','companies.all')->first();
        $nse   = Permission::where('slug','nse.access')->first();
        $report   = Permission::where('slug','report.access')->first();



        $admin->syncPermissions([  $companies->id, $config->id, $companiesAll->id, $nse->id, $report->id]);
        $admin->save();

        $executive->syncPermissions([ $companies->id]);
        $executive->save();

        $customer->syncPermissions([$company->id, $report->id]);
        $customer->save();

    }
}
