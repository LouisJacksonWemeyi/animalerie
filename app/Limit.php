<?php

namespace App;

class Limit extends DefaultModel
{
	public $timestamps = false;

	public static $rules = [
		'extrem_down' => 'required|numeric',
		'down' => 'required|numeric',
		'up' => 'required|numeric',
		'extrem_up' => 'required|numeric',
		'normal_color' => ['exists:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'color' => ['exists:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'extrem_color' => ['exists:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
	];
}
