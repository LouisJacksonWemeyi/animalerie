<?php

namespace App;

class AgrementSpecie extends DefaultModel
{    
	public $timestamps = false;
    protected $table = 'agrement_specie';

    public function specie()
    {
		return $this->belongsTo(Specie::class);
    }

    public function agrement()
    {
		return $this->belongsTo(Agrement::class);
    }

    public static $rules = [
            'specie_id' => 'required|exists:species,id|unique_with:agrement_specie,agrement_id|exists:species,id',
            'agrement_id' => 'required|exists:agrements,id',
            'url_file' => 'nullable|url', 
        ];

    public static $rules_update = [
            'url_file' => 'nullable|url'
        ];
}
