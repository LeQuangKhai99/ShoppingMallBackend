<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Component\Recusive;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->html = '';
        $this->category = $category;
    }
    public function index(){
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact("categories"));
    }

    public function create(){
        $html = $this->GetOption(null);
        return view('admin.category.add', compact("html"));
    }

    public function postCreate(Request $request){
        $this->category->create([
            'name'=>$request->name,
            'parent_id'=>$request->cate,
            'slug'=>str_slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id){
        $category = $this->category->find($id);
        $html = $this->GetOption($category->parent_id);
        return view("admin.category.edit", compact('category', "html"));
    }

    public function GetOption($parent_id){
        $data = Category::all();
        $recusive = new Recusive($data);

        $html = $recusive->Option("", 0, $parent_id);
        return $html;
    }

    public function postEdit($id, Request $request){
        $this->category->find($id)->update([
           'name'=>$request->name,
            'parent_id'=>$request->cate,
            'slug'=>str_slug($request->name)
        ]);
        return redirect()->route("categories.index");
    }

    public function delete($id){
        $this->category->find($id)->delete();
        return redirect()->route("categories.index");
    }
}
