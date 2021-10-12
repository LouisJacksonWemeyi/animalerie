<?php

namespace App;

class Place extends DefaultModel
{
	public $timestamps = false;

	public static $rules = ['name' => 'required'];

	public function info_places(){
		return $this->hasMany(InfoPlace::class);
	}



}


