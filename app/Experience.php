<?php

namespace App;

class Experience extends DefaultModel
{

    public static $rules = [
        'number'    => 'required',
        'total_animals' => 'required|integer',
        'severity_id'   => 'exists:severities,id',
        'note'  => ''
        ];

    	public function ethical_protocol()
    	{
    	    return $this->belongsTo(EthicalProtocol::class);
    	}    	

    	public function severity()
    	{
    	    return $this->belongsTo(Severity::class);
    	}    	

        public function real_severity()
        {
            return $this->belongsTo(Severity::class);
        }

    	public function cages()
    	{
    	    return $this->hasMany(Cage::class);
    	}

}
