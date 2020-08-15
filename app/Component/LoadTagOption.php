<?php
    namespace App\Component;
    class LoadTagOption{
        public function RenderTag($tags){
            $html = '';
            foreach ($tags as $tag){
                $html .= '<option selected="selected">'.$tag->name.'</option>';
            }
            return $html;
        }
    }
