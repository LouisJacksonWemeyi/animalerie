<?php

namespace App;

class StockRegistry extends DefaultModel
{
    protected $dates = ['expiration_date'];

    public static $rules = [
            'in' => 'nullable|numeric|required_without_all:out|min:0.01',
            'out' => 'nullable|numeric|required_without_all:in|min:0.00',
            'expiration_date' => 'nullable|date',
            'experience_id' => 'required|exists:experiences,id',
            'note' => 'nullable'
    ];

    public function supplier()
    {
		return $this->belongsTo(Supplier::class);
    }  
    
    public function user()
    {
		return $this->belongsTo(User::class);
    }  

    public function supply()
    {
		return $this->belongsTo(Supply::class);
    }
      
    public function experience()
    {
		return $this->belongsTo(Experience::class);
    }

    public function getDisplayExpireAttribute()
    {
        if (isset($this->expiration_date)) {
            return $this->expiration_date->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getValueExpireAttribute(){
        if (!empty($this->expiration_date)) {
            return $this->expiration_date->format("Y-m-d");
        }else{
            return "";
        }
    }

    public function getIsExpiredAttribute()
    {
        if (isset($this->expiration_date)) {
            return $this->value_expire <= now()->format("Y-m-d");
        }else{
            return false;
        }
    }    

    public function getExpirationAlertAttribute()
    {
        if ($this->is_expired) {
            return "<i class='darkorange fa fa-warning'></i>";
        }else{
            return "";
        }
    }
}
