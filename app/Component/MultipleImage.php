<?php
namespace App\Component;

class MultipleImage{

    public function RenderImage($images){
        $html = '<div style="display: block">';
        foreach ($images as $image) {
            $html .= '<img style="width: 150px; height: 150px; margin: 10px" src="'.$image->image_path.'" alt="">';
        }
        $html .= '</div>';
        return $html;
    }
}
