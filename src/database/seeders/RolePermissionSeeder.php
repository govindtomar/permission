<?php

namespace GovindTomar\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use GovindTomar\Permission\Models\Role;
use GovindTomar\Permission\Models\Permission;
use GovindTomar\Permission\Models\RolePermission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $routes = [
        	'create'	=> 	'Create', 
        	'store'		=> 	'NULL', 
        	'show'		=> 	'View', 
        	'index' 	=> 	'NULL', 
        	'update' 	=> 	'Update', 
        	'edit' 		=>	'NULL', 
        	'destroy' 	=>	'Delete'
        ];
        
        foreach ($permissions as $key => $permission) {
	        foreach ($roles as $key => $role) {
	            foreach ($routes as $key => $route) {
	                $check_route = RolePermission::where('route', $permission->route.'.'.$key)
	                    ->where('role_id', $role->id)->first();
	                if ($check_route == null) {
	                    $role_permission = new RolePermission;
	                    $role_permission->role_id = $role->id;
	                    $role_permission->permission_id = $permission->id;
	                    $role_permission->route = $permission->route.'.'.$key;
	                    if ($route == 'NULL') {
	                        $role_permission->relation_key = $last_permission->id;
	                    }else{
	                        $role_permission->display = 1;
	                        $role_permission->display_name = $route;
	                    }
	                    $role_permission->save();

	                    $last_permission = $role_permission;
	                }
	            }
	        }
        }
    }
}
