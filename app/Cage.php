<?php

namespace App;

class Cage extends DefaultModel
{
	protected $dates = ["last_cleaning"];
	
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function cage_type()
    {
        return $this->belongsTo(CageType::class);
    }

    public function getIsCleanAttribute()
    {
        return $this->last_cleaning->addDays(7) > now();   
    }

    public function scopeDirtyCages($query){
        return $query->where('last_cleaning', '<', now()->subDays(7));
    }
}
