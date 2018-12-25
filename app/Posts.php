<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";
    public $primaryKey = 'id';

    //associate a post with the user who posted it
    public function user(){
        return $this->belongsTo("App\User");
    }

}
