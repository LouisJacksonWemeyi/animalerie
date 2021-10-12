<?php

namespace App;

class CategoryContact extends DefaultModel
{
	public $timestamps = false;

    public static $rules = [
            "name" => 'required'
    ];

	public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
