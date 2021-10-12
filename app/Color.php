<?php

namespace App;

class Color extends DefaultModel
{
	public $timestamps = false;

	public static $rules = [
		'color' => ['required', 'unique:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'alias' => 'required'
	];

	public static $rules_update = [
		'color' => ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'alias' => 'required'
	];
}
