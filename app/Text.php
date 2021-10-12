<?php

namespace App;

class Text extends DefaultModel
{
	public $timestamps = false;

	public static $rules = ['text' => 'nullable'];
}
