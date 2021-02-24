<?php

namespace GovindTomar\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use GovindTomar\Permission\Models\Permission;
use GovindTomar\Permission\Helper\Helper;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$name = Helper::routeName();

        $permissions = [
        	[
        		'name'	=>	'Role URL',
        		'route'	=>	$name.'role',
        	],
        	[
        		'name'	=>	'Permission URL',
        		'route'	=>	$name.'permmision',
        	],
        	[
        		'name'	=>	'Role Permission URL',
        		'route'	=>	$name.'role.permission',
        	],
        ];

        foreach ($permissions as $key => $permission) {
        	$per = new Permission;
        	$per->name 	= 	$permission['name'];
        	$per->route =	$permission['route'];
        	$per->save(); 
        }
        
    }
}
