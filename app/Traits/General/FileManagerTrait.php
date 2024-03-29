<?php

namespace App\Traits\General;

use Illuminate\Support\Facades\Storage;

trait FileManagerTrait {



  //function upload file to storage/public/ $folders and return path
    public function uploadFile($file,$folders)
    {
        return '/storage/' . $file->storeAs($folders, $this->createName($file), 'public');
    }

    //generate name
    public function createName($file){
        return time().'_'.$file->getClientOriginalName();
    }


   // function delete old file from path parameter upload new file to storage/public / $folders
    public function fileManage($path ,$file ,$folders){

        $this->deleteFile($this->getrealpath($path));
        return $this->uploadFile($file,$folders);
    }

    //return real path of file after asset function

    public function getrealpath($path){
        return 'public/'.substr($path,strpos($path, 'storage/')+7);

    }

    //delete file if exists
    public function deleteFile($path)
    {
        if( Storage::exists($path)){
            Storage::delete($path);
            return 1;
        }
        return 0;
    }



}
