<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $role, $permission;
    public function __construct(Role $role, Permission $permission){
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index(){
        $roles = $this->role->latest()->paginate(5);
        return view('admin.role.index', ['roles'=>$roles]);
    }

    public function create(){
        $parentPermission = $this->permission->where('parent_id', '=', 0)->get();
        return view('admin.role.create', ['parentPermission'=>$parentPermission]);
    }

    public function postCreate(Request $request){
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name'=>$request->names,
                'display_name'=>$request->display_name
            ]);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        }catch (\Exception $exception){
            DB::rollBack();
            abort(403);
        }
    }

    public function edit($id){
        $parentPermission = $this->permission->where('parent_id', '=', 0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions()->get();

        return view('admin.role.edit', [
            'parentPermission'=>$parentPermission,
            'role'=>$role,
            'permissionChecked'=>$permissionChecked
        ]);
    }

    public function postEdit(Request $request, $id){
        try {
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name'=>$request->names,
                'display_name'=>$request->display_name
            ]);
            $role = $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        }catch (\Exception $exception){
            DB::rollBack();
            abort(403);
        }
    }

    public function delete($id){
        try {
            $this->role->find($id)->delete();
            return  response()->json([
                'code'=>200,
                'mess'=>'Success'
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code'=>500,
                'mess'=>'Err'
            ], 500);
        }
    }
}
