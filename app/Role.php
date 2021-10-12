<?php

namespace App;

class Role extends DefaultModel
{
	public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    } 
}
