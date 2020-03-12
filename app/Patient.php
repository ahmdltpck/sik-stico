<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];
    
    public function employee()
	{
	    return $this->belongsTo(Employee::class);
	}

	public function seat()
	{
		return $this->belongsTo(Seat::class);
	}
}
