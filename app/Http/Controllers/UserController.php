<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user, $role;
    public function __construct(User $user, Role $role){
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', ['users'=>$users]);
    }

    public function create(){
        $roles = $this->role->all();
        return view('admin.user.create', ['roles'=>$roles]);
    }

    public function postCreate(Request $request){
        $user = $this->user->create([
            'name'=>$request->names,
            'email'=>$request->email,
            'password'=>Hash::make($request->pass)
        ]);

        $user->roles()->attach($request->roles);
        return redirect()->route('users.index');
    }

    public function edit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $userRole = $user->roles()->get();
        return view('admin.user.edit', ['user'=>$user, 'roles'=>$roles, 'userRole'=>$userRole]);
    }

    public function postEdit(Request $request, $id){
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name'=>$request->names,
                'email'=>$request->email,
                'password'=>Hash::make($request->pass)
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->roles);
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            abort(404);
        }
    }

    public function delete($id){
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success'
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code'=>500,
                'mess'=>'err'
            ], 500);
        }
    }

}
