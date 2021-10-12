<?php

namespace App;

class Reservation extends DefaultModel
{    
	protected $dates = ["start", "end"];

	public static $rules = [
		'number' => 'required|numeric',
		'start' => 'required|date',
		'end' => 'required|date',
		'supply_id' => 'required|exists:supplies,id',
		'place_id' => 'required|exists:places,id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}  

	public function supply()
	{
		return $this->belongsTo(Supply::class);
	}

	public function place()
	{
		return $this->belongsTo(Place::class);
	}
}
