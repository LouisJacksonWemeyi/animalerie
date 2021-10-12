<?php

namespace App;

class EthicalProtocol extends DefaultModel
{
       	
	protected $dates = ["date_beginning", "date_end"];

    public static $rules = [
        'title' => 'required',
        'ethical_number' => 'required',
        'total_animals' => 'nullable|integer',
        'date_beginning' => 'nullable|date',
        'date_end' => 'nullable|date',
        'application_domain_id' => 'required|exists:application_domains,id',
        'agrement_id' => 'required|exists:agrements,id',
        'severity_id' => 'required|exists:severities,id',
        'uploaded' => 'nullable|boolean',
        'accepted' => 'nullable|boolean',
        'acceptation_email' => 'nullable|boolean',
        'retrospective_study' => 'nullable|boolean'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id');
    }
    
    public function agrement()
    {
        return $this->belongsTo(Agrement::class);
    }      	

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function archives()
    {
        return $this->hasMany(EthicalProtocolArchive::class);
    }

    public function domain()
    {
        return $this->belongsTo(ApplicationDomain::class, 'application_domain_id', 'id');
    }

    public function severity()
    {
        return $this->belongsTo(Severity::class);
    }   

    public function getBeginningAttribute(){
        if (!empty($this->date_beginning)) {
            return $this->date_beginning->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getEndAttribute(){
        if (!empty($this->date_end)) {
            return $this->date_end->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getValueBeginningAttribute(){
        if (!empty($this->date_beginning)) {
            return $this->date_beginning->format("Y-m-d");
        }else{
            return "";
        }
    }

    public function getValueEndAttribute(){
        if (!empty($this->date_end)) {
            return $this->date_end->format("Y-m-d");
        }else{
            return "";
        }
    }

    public function getFileUploadedAttribute(){
        return $this->uploaded ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
    }

    public function getCheckAcceptedAttribute(){
        return $this->accepted ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
    }

    public function getCheckAcceptationEmailAttribute(){
        return $this->acceptation_email ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
    }

    public function getCheckRetrospectiveStudyAttribute(){
        return $this->retrospective_study ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
    }

    public function getIsModifiedAttribute(){
        return $this->archives->isNotEmpty() ? "<i class='green fa fa-2x fa-check'></i>" : "<i class='red fa fa-2x fa-times'></i>";
    }

    public function getUsedAnimalsAttribute(){
        $experiences = Experience::where("ethical_protocol_id", $this->id)->get();
        return $experiences->sum('total_animals');

    }    

    public function getUnusedAnimalsAttribute(){
        return $this->total_animals - $this->used_animals;

    }
}
