<?php
namespace App\Handlers;

use Illuminate\Support\Str;

//config文件夹里直接用嘛
use Image;
class UploadImageHandler{
    // protected $allow_ext=['png','jpg'];

    // public function save($file,$floder,$file_prefix){
    //     $floder="uploads/imgs/$floder".date('Ym/d',time());

    //     $upload_path=public_path().'/'.$floder;

    //     $extension=strtolower($file->getClientOriginalExtension())?:'png';


    //     $filename=$file_prefix.'_'.time().'_'.Str::random(10).'.'.$extension;

    //     if(!in_array($extension,$this->allow_ext)){
    //         return false;
    //     }

    //     $file->move($upload_path,$filename);

    //     return ['path'=>config('app.url')."/$floder/$filename"];
    // }


    protected $allow_ext=["png", "jpg", "gif", 'jpeg'];

    public function save($file,$floder,$file_prefix,$max_width=false){
        //放到今天的目录下
        $floder='/upload/images/'.$floder.'/'.date('Y/m/d',time()).'/';
        //生成文件夹路径
        $upload_path=public_path()."/".$floder;

        $extension=strtolower($file->getClientOriginalExtension())?:'png';

        $filename=$file_prefix.'_'.time().'_'.Str::random(10).'.'.$extension;

        if(!in_array($extension,$this->allow_ext)){
            return false;
        }

      
        $file->move($upload_path,$filename);

        if($max_width && $extension !='git'){
            $this->reduceSize($upload_path.'/'.$filename,$max_width);
        }


        return ['path'=>config('app.url').$floder.$filename];


    }

    public function reduceSize($filepath,$max_width){
        $image=Image::make($filepath);
        $image->resize($max_width,null,function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save();

    }
}