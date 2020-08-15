<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait{
    public function Upload($request, $field_name, $forder_name){
        if ($request->hasFile($field_name)){
            $file = $request->$field_name;
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = str_random(20).'.'.$file->getClientOriginalExtension();
            $path = $request->file($field_name)->storeAs('public/photos/'.$forder_name.'/'.auth()->id(), $filenameHash);
            $dataUpload = [
                'file_name'=>$filenameOrigin,
                'file_path'=>Storage::url($path)
            ];
            return $dataUpload;
        }
        else
            return null;

    }

    public function UploadMultiple($file, $forder_name){
        $filenameOrigin = $file->getClientOriginalName();
        $filenameHash = str_random(20).'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/photos/'.$forder_name.'/'.auth()->id(), $filenameHash);
        $dataUpload = [
            'file_name'=>$filenameOrigin,
            'file_path'=>Storage::url($path)
        ];
        return $dataUpload;

    }
}
