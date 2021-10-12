<?php

namespace App;

class InfoPlace extends DefaultModel
{
	protected $dates = ['info_date'];

	public static $rules = [
		'humidity' => 'required|numeric',
		'temperature' => 'required|numeric',
		'note' => 'nullable',
		'info_date' => 'required|date',
		'place_id' => 'required|exists:places,id',
	];

   	public function place()
	{
	    return $this->belongsTo(Place::class);
	}

   	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function getDateAttribute(){
		if (!empty($this->info_date)) {
			return $this->info_date->format('d/m/Y');
		}
		return "Pas de date";
	}
	public function getDateTimestampAttribute(){
		return $this->info_date->getTimestamp();
	}

	public function getCheckAttribute(){
		return $this->is_valid ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
	}

	public function getTempColorAttribute(){
		$limit = Limit::where('for', 'temperature')->first();
		if ($this->temperature <= $limit->extrem_down) {
			return $limit->extrem_color ;
		}elseif($this->temperature > $limit->extrem_down && $this->temperature <= $limit->down){
			return $limit->color;
		}elseif($this->temperature >= $limit->up && $this->temperature < $limit->extrem_up){
			return $limit->color;
		}elseif($this->temperature >= $limit->extrem_up){
			return $limit->extrem_color ;
		}else{
			return $limit->normal_color;
		}
	}

	public function getHumidColorAttribute(){
		$limit = Limit::where('for', 'humidity')->first();
		if ($this->humidity <= $limit->extrem_down) {
			return $limit->extrem_color ;
		}elseif($this->humidity > $limit->extrem_down && $this->humidity <= $limit->down){
			return $limit->color;
		}elseif($this->humidity >= $limit->up && $this->humidity < $limit->extrem_up){
			return $limit->color;
		}elseif($this->humidity >= $limit->extrem_up){
			return $limit->extrem_color;
		}else{
			return $limit->normal_color;
		}
	}

	public function getIsTodayAttribute(){
		return $this->info_date->format("Y-m-d") == now()->format("Y-m-d");
	}	

	public function getRegisteredTodayAttribute(){
		return $this->created->format("Y-m-d") == now()->format("Y-m-d");
	}
}
