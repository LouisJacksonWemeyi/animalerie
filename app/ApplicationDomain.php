<?php

namespace App;

class ApplicationDomain extends DefaultModel
{
	public $timestamps = false;
	
	public static $rules = ['title' => 'required'];

    public function protocols()
    {
        return $this->hasMany(EthicalProtocol::class);
    }
}
