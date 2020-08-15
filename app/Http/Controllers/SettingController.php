<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingCreateRequest;
use App\settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $setting;
    public function __construct(settings $setting)
    {
        $this->setting = $setting;
    }

    public function index(){
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', [
            'settings'=>$settings
        ]);
    }

    public function create(){
        return view('admin.setting.create');
    }

    public function postCreate(SettingCreateRequest $request){
        $this->setting->create([
            'config_key'=>$request->key,
            'config_value'=>$request->value,
            'type'=>$request->type
        ]);
        return redirect()->route('settings.index');
    }

    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', ['setting'=>$setting]);
    }

    public function postEdit(Request $request, $id){
        $setting = $this->setting->find($id);
        $setting->update([
           'config_key'=>$request->key,
           'config_value'=>$request->value
        ]);
        return redirect()->route('settings.index');
    }

    public function delete($id){
        try {
            $this->setting->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success'
            ], 200);
        }
        catch (\Exception $e){
            return response()->json([
                'code'=>500,
                'mess'=>'err'
            ], 500);
        }
    }

}
