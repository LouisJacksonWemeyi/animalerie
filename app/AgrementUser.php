<?php

namespace App;

class AgrementUser extends DefaultModel
{    
	public $timestamps = false;
    protected $table = 'agrement_user';

    public static $rules = [
            "user_id" => 'exists:users,id|unique_with:agrement_user,agrement_id',
            'agrement_id' => 'required|exists:agrements,id'
        ];
}
