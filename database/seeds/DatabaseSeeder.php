<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(QuestionAnswersTableSeeder::class);
        $this->call(NseLevelsTableSeeder::class);


    }
}
