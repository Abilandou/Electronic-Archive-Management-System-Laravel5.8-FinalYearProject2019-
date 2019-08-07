<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
        $roles = [
        	'Dean',
        	'HOD',
        	'Secratary',
        	'Prof',
        	'User',
        ];

        foreach($roles as $role){
        	Role::create(['name' => $role]);
        }


        // $dean = Role::create(['name' => 'Dean']);
        // $hod  = Role::create(['name' => 'HOD']);
        // $sectary = Role::create(['name' => 'secratary']);
        // $prof  = Role::create(['name' => 'PROF']);
        // $users =  Role::create(['name' => 'User']);

    }
}
