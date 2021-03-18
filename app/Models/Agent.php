<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    //
    protected $fillable = ['firstname','middlename','lastname','email','contactNo','image'];

    public function images()
    {
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function house(){
        return $this->belongsTo('App\Models\House');
    }
}
