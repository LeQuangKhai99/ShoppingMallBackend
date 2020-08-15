<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderCreateRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', ['sliders'=>$sliders]);
    }

    public function create(){
        return view('admin.slider.create');
    }

    public function postCreate(SliderCreateRequest $request){
        $dataCreateSlider = [
            'name'=>$request->names,
            'description'=>$request->description,
        ];
        $data = $this->Upload($request, 'image', 'slider');
        if ($data != null){
            $dataCreateSlider['image_name'] = $data['file_name'];
            $dataCreateSlider['image_path'] = $data['file_path'];
        }
        $this->slider->create($dataCreateSlider);
        return redirect()->route('sliders.index');
    }

    public function edit($id){
        $slider = $this->slider->find($id);

        return view('admin.slider.edit', [
            'slider'=>$slider
        ]);
    }

    public function postEdit(SliderCreateRequest $request, $id){
        $slider = $this->slider->find($id);
        $dataUpdateSlider = [
            'name'=>$request->names,
            'description'=>$request->description
        ];

        $data = $this->Upload($request, 'image', 'slider');
        if ($data != null){
            $dataUpdateSlider['image_name'] = $data['file_name'];
            $dataUpdateSlider['image_path'] = $data['file_path'];
        }

        $slider->update($dataUpdateSlider);
        return redirect()->route('sliders.index');
    }

    public function delete($id){
        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success'
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'code'=>500,
                'mess'=>'error'
            ], 500);
        }

    }
}
