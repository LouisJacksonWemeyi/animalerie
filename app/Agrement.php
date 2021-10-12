<?php

namespace App;

class Agrement extends DefaultModel
{
	protected $dates = ["validity_date"];

	public static $rules = [
            'name' => 'required',
            'user' => 'exists:users,id|required',
        ];

   	public function user()
	{
	    return $this->belongsTo(User::class);
	}

   	public function species()
	{
	    return $this->belongsToMany(Specie::class)->withPivot('id')->withPivot('url_file');
	}

   	public function users()
	{
	    return $this->belongsToMany(User::class)->withPivot('id');
	}

	public function getCheckAttribute(){
		return $this->is_valid ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
	}

	public function getIsValidAttribute(){
		return $this->validity_date > now();
	}

	
}