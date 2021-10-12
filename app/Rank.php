<?php

namespace App;

class Rank extends DefaultModel
{
	public $timestamps = false;

	public function users()
	{
	    return $this->hasMany(User::class);
	}

}
