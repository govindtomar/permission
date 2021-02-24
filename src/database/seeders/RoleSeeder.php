<?php

namespace GovindTomar\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use GovindTomar\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Role::truncate();

    	$userRoles = [
        	[
	        	'name'	=>	'Super Admin',
	        	'slug'	=>	'superadmin',
	        ],
	        [
	        	'name'	=>	'Admin',
	        	'slug'	=>	'admin',
	        ],
	        [
	        	'name'	=>	'User',
	        	'slug'	=>	'user',
	        ],
        ];

        foreach ($userRoles as $key => $userRole) {
	        $role = new Role;
	        $role->name = $userRole['name'];
	        $role->slug = $userRole['slug'];
	        $role->save();
        }
    }
}
