<?php

namespace App;

class EthicalProtocolUser extends DefaultModel
{
	public $timestamps = false;
    protected $table = 'ethical_protocol_user';
	
	public static $rules = [
		'user_id' => 'required|unique_with:ethical_protocol_user,ethical_protocol_id|exists:users,id',
		'protocol_id' => 'required|exists:ethical_protocols,id'
	];
}
