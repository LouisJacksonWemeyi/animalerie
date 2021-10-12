<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public static $rules = [
            "lastname" => 'required', 
            "firstname" => 'required', 
            "email" => 'email|unique:users|required', 
            "rank" => 'exists:ranks,id|required',
        ];

    public static $rules_update = [
            "lastname" => 'required', 
            "firstname" => 'required', 
            "email" => 'email|required', 
            "rank" => 'exists:ranks,id|required'
        ];

    public static $rules_password = [
            "new_password" => 'required',
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'firstname', 'lastname', 'password', 'rank_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agrements()
    {
        return $this->hasMany(Agrement::class);
    }

    public function agrement_users()
    {
        return $this->belongsToMany(Agrement::class);
    }

    public function info_places()
    {
        return $this->hasMany(InfoPlace::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }    

    public function protocols()
    {
        return $this->belongsToMany(EthicalProtocol::class);
    }

    public function user_protocols()
    {
        return $this->hasMany(EthicalProtocol::class);
    }

    public function animals()
    {
        return $this->hasMany(StockAnimal::class);
    }

    public function getNameAttribute()
    {
        return $this->lastname . " " . $this->firstname;
    }

    public function getActivatedAttribute()
    {
         if(!$this->active){
            return "<a title='Activer ce membre' href='".route('user.activate', ['id' => $this->id])."'>
                <button type='button' class='btn btn-outline btn-info'><i class='fa fa-unlock'></i></button>
            </a>";
         }else{
            return "<a title='Désactiver ce membre' href='".route('user.deactivate', ['id' => $this->id])."'>
                <button type='button' class='btn btn-outline btn-info'><i class='fa fa-lock'></i></button>
            </a>";
         }
    }

    public function getIsAdminAttribute(){
        return $this->rank->status == "admin";
    }

    public function isAdmin(){
        return $this->is_admin;
    }

    // To generate "selected" on HTML list, saved value to check with the foreign in an other model and old value if the form didn't pass the validation. (copy from defaulModel because this one extends another one)

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
