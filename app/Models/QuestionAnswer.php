<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    //
    protected $appends = [
      'image_src'
    ];

    public function path_image(){
        return base_path() . env('PATH_IMAGES');
    }

    public function question(){
        return $this->belongsTo('App\Models\Question');
    }

    public function isFile(){

        return is_file($this->path_image().$this->answer);
    }

    public function getImageSrcAttribute(){
        if($this->isFile()) return asset('images/answers/' . $this->answer);
    }
}
