<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use Illuminate\Http\Request;
use App\Component\Recusive;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    private $menu;

    public function __construct(Menu $menu){
        $this->menu = $menu;
    }
    public function index(){
        $menus = $this->menu->latest()->paginate(5);
        return view('admin.menu.index', ['menus'=>$menus]);
    }

    public function create(){
        $html = $this->GetOption(null);
        return view('admin.menu.add', compact('html'));
    }

    public function GetOption($parent_id){
        $data = Menu::all();
        $recusive = new Recusive($data);
        $html = $recusive->Option("", 0, $parent_id);
        return $html;
    }

    public function postCreate(Request $request){
        $this->menu->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>str_slug($request->name)
        ]);
        return redirect()->route('admin.menus.index');
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $html = $this->GetOption($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'html'));
    }

    public function postEdit($id, Request $request){
        $this->menu->find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>str_slug($request->name)
        ]);
        return redirect()->route('admin.menus.index');
    }

    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menus.index');
    }
}
