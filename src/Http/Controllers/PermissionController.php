<?php
namespace GovindTomar\Permission\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GovindTomar\Permission\Http\Requests\PermissionRequest;
use GovindTomar\Permission\Models\Permission;
use GovindTomar\Permission\Models\RolePermission;
use GovindTomar\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        try{
            $permissions = Permission::paginate(20);
            return view("permission::permission/index", compact("permissions"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function create()
    {
        try{
            return view("permission::permission/create");
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
            $permission = Permission::find($id);            
            return view("permission::permission/show", compact("permission"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $permission =  Permission::find($id);
            return view("permission::permission/edit", compact("permission"));
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
            Permission::find($id)->delete();
            return redirect("admin/permission")->with('success','Successfully delete permission');

        }catch(\Exception $e){
            return back()->with('error','permission was delete');
        }
    }

    public function update_permissions($permission){
        $roles = Role::all();
        $routes = ['create' => 'Create', 'store' => 'NULL', 'show' => 'View', 'index' => 'NULL', 'update' => 'Update', 'edit' => 'NULL', 'destroy' => 'Delete'];
        foreach ($roles as $key => $role) {
            foreach ($routes as $key => $route) {
                $check_route = RolePermission::where('route', $role->url.'.'.$permission->route.'.'.$key)->first();
                if ($check_route == null) {
                    $role_permission = new RolePermission;
                    $role_permission->role_id = $role->id;
                    $role_permission->permission_id = $permission->id;
                    $role_permission->route = $role->url.'.'.$permission->route.'.'.$key;
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


    public function role_permission_index($url)
    {
        try{
            $role = Role::where('url', $url)->first();
            $this->role_id = $role->id;

            $permissions  = Permission::with(['role_permissions' => function($query){
                $query->where('display', 1);
                $query->where('role_id', $this->role_id);
            }])->get();

            // return $permissions;
            return view("permission::permission/role-permission", compact("permissions", "role"));
        }catch(\Exception $e){
            return back();
        }
    }


    public function role_permission_update(Request $request, $url)
    {
        // return $request->all();
        $role = Role::where('url', $url)->first();

        RolePermission::where('role_id', $role->id)->update([
            'status'    =>  0,
        ]);
        if ($request->permission != null) {
            foreach ($request->permission as $route => $toggle) {
                if ($toggle == 'on') {
                    $status = 1;
                }else{
                    $status = 0;
                }
                $role_per = RolePermission::where('route', $route)->first();
                $role_per->status = $status;
                $role_per->save();

                $role_per = RolePermission::where('relation_key', $role_per->id)->first();
                if ($role_per != null) {
                    $role_per->status = $status;
                    $role_per->save();
                }
            }
        }
        return back();
    }

    public function role_permission_add_new(Request $request){
        // return $request->all();
        $roles = Role::all();
        $permission = Permission::where('route', $request->permission)->first();

        foreach ($roles as $key => $role) {
            $role_permission = RolePermission::where('route', $role->url.'.'.$permission->route.'.'.$request->view_delete)->first();
            if ($role_permission == null) {
                $role_permission = new RolePermission;
                $role_permission->role_id = $role->id;
                $role_permission->permission_id = $permission->id;
                $role_permission->route = $role->url.'.'.$permission->route.'.'.$request->view_delete;
                $role_permission->display = 1;
                $role_permission->display_name = $request->view_delete_name;                
                $role_permission->save();
            }

            if ($request->create_update != null) {
                $new_role_permission = RolePermission::where('route', $role->url.'.'.$permission->route.'.'.$request->create_update)->first();
                if ($new_role_permission == null) {
                    $new_role_permission = new RolePermission;
                    $new_role_permission->role_id = $role->id;
                    $new_role_permission->permission_id = $permission->id;
                    $new_role_permission->route = $role->url.'.'.$permission->route.'.'.$request->create_update;   
                    $new_role_permission->relation_key = $role_permission->id;           
                    $new_role_permission->save();
                }
            }
        }
        return response()->json($role_permission);
    }

}
