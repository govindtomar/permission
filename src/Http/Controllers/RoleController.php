<?php
namespace GovindTomar\Permission\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GovindTomar\Permission\Http\Requests\RoleRequest;
use GovindTomar\Permission\Models\Role;
use GovindTomar\Permission\Helper\Helper;
use DB;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware(['web', 'permission']);
    }

    public function index()
    {
        try{
            $route = Helper::route();
            $roles = Role::paginate(20);
            return view("permission::user-role.role.index", compact("roles", "route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function create()
    {
        try{
            $route = Helper::route();
            return view("permission::user-role.role.create", compact("route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function store(RoleRequest $request)
    {
        try{
            $role = Role::create($request->all());
            return back()->with('success','You have successfully inserted new role');
        }catch(\Exception $e){
            return back()->with('error','Your record has been not submitted successfully ');
        }
    }

    public function show($id)
    {
        try{
            $route = Helper::route();
            $role = Role::find($id);
            return view("permission::user-role.role.show", compact("role", "route"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $route = Helper::route();
            $role =  Role::find($id);
            return view("permission::user-role.role.edit", compact("role", "route"));
        }catch(\Exception $e){
            return back();
        }

    }

    public function update(RoleRequest $request)
    {
        // return $request->all();
        try{
            $role =  Role::find($request->id);
            $role->name  =  $request->name;
			$role->slug  =  $request->slug;
            $role->save();

            return back()->with('success','You have successfully updated role');
        }catch(\Exception $e){
            return back()->with('error','Your record has been not updated successfully');
        }
    }

    public function destroy($id)
    {
        try{
            $route = Helper::route();
            Role::find($id)->delete();
            return redirect($route."role")->with('success','Successfully delete role');

        }catch(\Exception $e){
            return back()->with('error','role was delete');
        }
    }

}
