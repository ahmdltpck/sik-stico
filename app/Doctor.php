<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];
    
    public function specialist()
	{
	    return $this->belongsTo(Specialist::class);
	}
}
