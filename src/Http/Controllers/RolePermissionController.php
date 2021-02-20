<?php
namespace GovindTomar\Permission\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use GovindTomar\Permission\Http\Requests\PermissionRequest;
use GovindTomar\Permission\Models\Permission;
use GovindTomar\Permission\Models\RolePermission;
use GovindTomar\Permission\Models\Role;
use GovindTomar\Permission\Helper\Helper;

class RolePermissionController extends Controller
{
    public function __construct(){
        $this->middleware(['web', 'permission']);
    }

    public function role_permission_index($slug)
    {
        try{
            $role = Role::where('slug', $slug)->first();
            $this->role_id = $role->id;

            $permissions  = Permission::with(['role_permissions' => function($query){
                $query->where('display', 1);
                $query->where('role_id', $this->role_id);
            }])->get();

            // return $permissions;
            $route = Helper::route();
            return view("permission::user-role.role-permission.index", compact("permissions", "role", "route"));
        }catch(\Exception $e){
            return back();
        }
    }


    public function role_permission_update(Request $request, $slug)
    {
        // return $request->all();
        $role = Role::where('slug', $slug)->first();

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
                $role_per = RolePermission::where('route', $route)->where('role_id', $role->id)->first();
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
            $role_permission = RolePermission::where('route', $permission->route.'.'.$request->view_delete)
                ->where('role_id', $role->id)->first();
            if ($role_permission == null) {
                $role_permission = new RolePermission;
                $role_permission->role_id = $role->id;
                $role_permission->permission_id = $permission->id;
                $role_permission->route = $permission->route.'.'.$request->view_delete;
                $role_permission->display = 1;
                $role_permission->display_name = $request->view_delete_name;
                $role_permission->save();
            }

            if (!empty($request->create_update)) {
                $new_role_permission = RolePermission::where('route', $permission->route.'.'.$request->create_update)
                    ->where('role_id', $role->id)->first();
                if ($new_role_permission == null) {
                    $new_role_permission = new RolePermission;
                    $new_role_permission->role_id = $role->id;
                    $new_role_permission->permission_id = $permission->id;
                    $new_role_permission->route = $permission->route.'.'.$request->create_update;
                    $new_role_permission->relation_key = $role_permission->id;
                    $new_role_permission->save();
                }
            }
        }
        return response()->json($role_permission);
    }

}
