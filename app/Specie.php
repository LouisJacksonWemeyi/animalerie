<?php

namespace App;

class Specie extends DefaultModel
{
	public $timestamps = false;
    
    public static $rules = ['name' => 'required'];
    
    protected $table = 'species';

   	public function agrements()
	{
	    return $this->belongsToMany(Agrement::class);
	}
}
