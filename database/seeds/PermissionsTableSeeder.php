<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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

        $permissions = [
        	'upload',
        	'share',
        	'delete',
        	'edit',
        	'create',
        	'download',
        	'view',
        ];
        foreach($permissions as $permission){
        	Permission::create(['name' => $permission]);
        }

    }
}
