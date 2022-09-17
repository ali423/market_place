<?php

namespace App\Services;

class UploadService
{
   public function upload($file, string $patch) :string
   {
       $file_name=$file->getClientOriginalName();
       return $file->storeAs('public/upload/'.$patch, str_shuffle(time()) . $file_name);
   }
}
