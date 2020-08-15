<?php

namespace App\Http\Controllers;

use App\Component\Recusive;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    private $permission;
    public function __construct(Permission $permission){
        $this->permission = $permission;
    }

    public function index(){
        $permissions = $this->permission->latest()->paginate(10);
        return view('admin.permission.index', ['permissions'=>$permissions]);
    }

    public function create(){
        $data = $this->permission->all();
        $recusive = new Recusive($data);
        $html = $recusive->Option('', 0, null);
        return view('admin.permission.create', ['html'=>$html]);
    }

    public function postCreate(Request $request){
        if ($request->module_parent == 0){
            $this->permission->create([
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'parent_id'=>$request->module_parent
            ]);
        }
        else{
            $permissionParent = $this->permission->find($request->module_parent);
            $permissionChild = $this->permission->find($permissionParent->id);
            $key_code = $permissionChild->display_name.'_'.$request->display_name;

            $this->permission->create([
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'parent_id'=>$request->module_parent,
                'key_code'=>$key_code
            ]);
        }
        return redirect()->route('permissions.index');
    }

    public function edit($id){
        $permission = $this->permission->find($id);
        $data = $this->permission->all();
        $recusive = new Recusive($data);
        $html = $recusive->Option('', 0, $permission->parent_id);
        return view('admin.permission.edit', ['html'=>$html, 'permission'=>$permission]);
    }

    public function postEdit(Request $request, $id){
        $permission = $this->permission->find($id);

        $permissionParent = $this->permission->find($request->module_parent);
        $permissionChild = $this->permission->find($permissionParent->id);
        $key_code = $permissionChild->display_name.'_'.$request->display_name;

        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'parent_id'=>$request->module_parent,
            'key_code'=>$key_code
        ]);

        return redirect()->route('permissions.index');
    }

    public function delete($id){
        try {
            $this->permission->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'code'=>500,
                'mess'=>'err'
            ], 500);
        }
    }
}
