<?php

namespace App;

class GetNew extends DefaultModel
{
	protected $table = "news";
	protected $dates = ["display_start", "display_end"];

	public static $rules = [
		'title' => 'required',
		'content' => 'nullable',
		'display_color' => ['required', 'exists:colors,color', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
		'display_start' => 'required|date',
		'display_end' => 'required|date'
	];

	public function display_color()
	{
	    return $this->belongsTo(Color::class);
	}


	public function scopeToDisplay($query){
		return $this->where([['display_start', "<=", now()->format('Y-m-d')],['display_end', '>=', now()->format('Y-m-d')],]);
	}
}
