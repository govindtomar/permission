<?php
namespace GovindTomar\Permission\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GovindTomar\Permission\Http\Requests\PermissionRequest;
use GovindTomar\Permission\Models\Permission;
use GovindTomar\Permission\Models\RolePermission;
use GovindTomar\Permission\Models\Role;
use GovindTomar\Permission\Helper\Helper;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware(['web', 'permission']);
    }

    public function index()
    {
        try{
            $route = Helper::route();
            $permissions = Permission::paginate(20);
            return view("permission::user-role.permission.index", compact("permissions", "route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function create()
    {
        try{
            $route = Helper::route();
            return view("permission::user-role.permission.create", compact("route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function store(PermissionRequest $request)
    {
        try{
            $permission = Permission::create($request->all());
            $this->update_permissions($permission);
            return back()->with('success','You have successfully inserted new permission');
        }catch(\Exception $e){
            return back()->with('error','Your record has been not submitted successfully ');
        }
    }


    public function show($id)
    {
        try{
            $route = Helper::route();
            $permission = Permission::find($id);
            return view("permission::user-role.permission.show", compact("permission", "route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $route = Helper::route();
            $permission =  Permission::find($id);
            return view("permission::user-role.permission.edit", compact("permission", "route"));
        }catch(\Exception $e){
            return back();
        }

    }

    public function update(PermissionRequest $request)
    {
        try{
            $permission =  Permission::find($request->id);
            $permission->name  =  $request->name;
			$permission->route  =  $request->route;
            $permission->save();
            $this->update_permissions($permission);
            return back()->with('success','You have successfully updated permission');
        }catch(\Exception $e){
            return back()->with('error','Your record has been not updated successfully');
        }
    }

    public function destroy($id)
    {
        try{
            $route = Helper::route();
            Permission::find($id)->delete();
            return redirect($route."permission")->with('success','Successfully delete permission');

        }catch(\Exception $e){
            return back()->with('error','permission was delete');
        }
    }

    public function update_permissions($permission){
        $roles = Role::all();
        $routes = ['create' => 'Create', 'store' => 'NULL', 'show' => 'View', 'index' => 'NULL', 'update' => 'Update', 'edit' => 'NULL', 'destroy' => 'Delete'];
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
