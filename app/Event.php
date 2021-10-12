<?php

namespace App;

class Event extends DefaultModel
{
	protected $dates = ["date"];

	public static $rules = [
		'title' => 'required',
		'description' => '',
		'date' => 'required|date',
		'display_color' => ['exists:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'ethical_protocol_id' => 'nullable|exists:ethical_protocols,id'
	];

	public function ethical_protocol()
	{
	    return $this->belongsTo(EthicalProtocol::class);
	}

	public function color()
	{
	    return $this->belongsTo(Color::class, 'display_color', 'color');
	}

	public function scopeThreeMonthsEvents($query){
	    return $query->whereBetween('date', [now(), now()->addMonths(3)]);
	}
}
