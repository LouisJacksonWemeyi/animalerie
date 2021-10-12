<?php

namespace App;

class Severity extends DefaultModel
{
    public $timestamps = false;

	public static $rules = ['title' => 'required'];
    
}
