<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $table = "contents";
    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
