<?php

namespace App;

class Link extends DefaultModel
{
	public $timestamps = false;

	public static $rules = [
		'title' => 'required',
		'url' => 'required|url'
	];
}
