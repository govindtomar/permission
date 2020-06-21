<?php
namespace GovindTomar\Permission\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GovindTomar\Permission\Http\Requests\RoleRequest;
use GovindTomar\Permission\Models\Role;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        try{
            $roles = Role::paginate(20);
            return view("permission::role/index", compact("roles"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function create()
    {
        try{
            return view("permission::role/create");
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
            $role = Role::find($id);            
            return view("permission::role/show", compact("role"));
        }catch(\Exception $e){
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $role =  Role::find($id);
            return view("permission::role/edit", compact("role"));
        }catch(\Exception $e){
            return back();
        }

    }

    public function update(RoleRequest $request)
    {
        try{
            $role =  Role::find($request->id);
            $role->name  =  $request->name;
			$role->url  =  $request->url;
            $role->save();
            
            return back()->with('success','You have successfully updated role');
        }catch(\Exception $e){
            return back()->with('error','Your record has been not updated successfully');
        }
    }

    public function destroy($id)
    {
        try{
            Role::find($id)->delete();
            return redirect("admin/role")->with('success','Successfully delete role');

        }catch(\Exception $e){
            return back()->with('error','role was delete');
        }
    }
    
}
