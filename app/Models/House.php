<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //
    protected $fillable = ['floor_area','lot_area','price','description','title','street','city','province','country','beds','bathroom','listing_type','is_sold','agent_id'];


    public function images()
    {
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function features()
    {
        return $this->hasMany('App\Models\Feature');
    }

    public function agent(){
        return $this->belongsTo('App\Models\Agent');
    }
}