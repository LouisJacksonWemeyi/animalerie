<?php

namespace App;

class Contact extends DefaultModel
{
	public $timestamps = false;

	public function category_contact()
    {
        return $this->belongsTo(CategoryContact::class);
    }

    public function getNameAttribute()
    {
        return $this->lastname . " " . $this->firstname;
    }

    public static $rules = [
        'lastname' => 'required',
        'firstname' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'note' => ''
        ];
}
