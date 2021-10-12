<?php

namespace App;

class CageType extends DefaultModel
{
	public $timestamps = false;

	public function cage()
    {
        return $this->hasMany(Cage::class);
    }
}
