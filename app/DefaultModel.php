<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultModel extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function getDisplayCreatedAttribute(){
        if (!empty($this->created)) {
            return $this->created->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getDisplayFullCreatedAttribute(){
        if (!empty($this->created)) {
            return $this->created->format("H:i d/m/Y");
        }else{
            return "";
        }
    }

    public function getDisplayModifiedAttribute(){
        if (!empty($this->modified)) {
            return $this->modified->format("d/m/Y");
        }else{
            return "";
        }
    }

    public function getDisplayFullModifiedAttribute(){
        if (!empty($this->modified)) {
            return $this->modified->format("H:i d/m/Y");
        }else{
            return "";
        }
    }

    // To generate "selected" on HTML list, saved value to check with the foreign in an other model and old value if the form didn't pass the validation.

    public function hasToBeSelected($saved_value = null, $old_value = null)
    {
        if($old_value && ($old_value == $this->id)){
            return "selected";
        } elseif ( !$old_value && ($saved_value == $this->id)) {
            return "selected";
        }else{
            return NULL;
        }
    }

}
