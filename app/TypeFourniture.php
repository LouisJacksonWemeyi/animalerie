<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeFourniture extends DefaultModel
{
    public $timestamps = false;
    
    public static $rules = ['name' => 'required'];
    
    protected $table = 'type_fournitures';

   	public function agrements()
	{
	    return $this->belongsToMany(Agrement::class);
	}
}
