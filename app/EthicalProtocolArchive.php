<?php

namespace App;

class EthicalProtocolArchive extends DefaultModel
{
	public $timestamps = false;
	protected $dates = ['date'];
    
    public static $rules = [
        'date' => 'required|date',
        'note' => 'required',
        'number' => 'integer',
        'date_end' => 'nullable|date'
    ];

	public function protocol()
    {
        return $this->belongsTo(EthicalProtocol::class);
    }

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayDateAttribute(){
        if (!empty($this->date)) {
            return $this->date->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getValueDateAttribute(){
        if (!empty($this->date)) {
            return $this->date->format("Y-m-d");
        }else{
            return "";
        }
    }

}
