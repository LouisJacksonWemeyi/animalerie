<?php

namespace App;

class Supply extends DefaultModel
{
	public $timestamps = false;

	public static $rules = [
			'name' => 'required',
			'unit_id' => 'required|exists:units,id'
	];

   	public function stock_registries()
	{
		return $this->hasMany(StockRegistry::class);
	}   
	
	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}

	public function getExpirationAlertAttribute()
	{
	    if ($this->has_expired) {
	        return "<i class='darkorange fa fa-warning'></i>";
	    }else{
	        return "";
	    }
	}

	public function getHasExpiredAttribute()
	{
		foreach ($this->stock_registries as $registry) {
	    	if (isset($registry->expiration_date)) {
	    	    return $registry->expiration_date->format("Y-m-d") <= now()->format("Y-m-d");
	    	}else{
	    	    return false;
	    	}
		}
	} 

	public function getStockAttribute()
	{
		return $this->stock_registries->sum("in") - $this->stock_registries->sum("out");
	} 
}
