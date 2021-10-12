<?php

namespace App;

class Unit extends DefaultModel
{
	public $timestamps = false;

	public static $rules = ['name' => 'required'];

   	public function stock_registries()
   	{
		return $this->belongsToMany(Supply::class);
  	}
}
