<?php

namespace App\Providers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Agrement as Agrement;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('titulaire_registry', function($user, $registry){
            return $user->id == $registry->user_id;
        });

        Gate::define('titulaire_event', function($user, $event){
            return $user->id == $event->user_id;
        });

        Gate::define('titulaire_infoplace', function($user, $infoplace){
            return $user->id == $infoplace->user_id;
        });

        Gate::define('titulaire_reservation', function($user, $reservation){
            return $user->id == $reservation->user_id;
        });

        Gate::define('titulaire_protocole', function($user, $protocol){
            return $user->id == $protocol->user_id;
        });
        
        Gate::define('utilisateur_protocol', function($user, $protocol){
            $ethical_protocol_users = DB::table('ethical_protocol_user')->where('ethical_protocol_id', '=', $protocol->id)->get();
            $true = FALSE;
            //echo $agrement_users;
            foreach ($ethical_protocol_users as $ethical_protocol_user) {
                if($ethical_protocol_user->user_id == $user->id){
                    $true = TRUE;
                    break;
                }
            }
             return $true == TRUE;
        }); 

        Gate::define('utilisateur_agrement', function($user, $agrement){
            $agrement_users = DB::table('agrement_user')->where('agrement_id', '=', $agrement->id)->get();
            $true = FALSE;
            //echo $agrement_users;
            foreach ($agrement_users as $agrement_user) {
                if($agrement_user->user_id == $user->id){
                    $true = TRUE;
                    break;
                }
            }
             return $true == TRUE;
        }); 

        Gate::define('titulaire_agrement', function($user, $agrement){
            return $user->id == $agrement->user_id;
        }); 

         Gate::define('isadmin', function(){
            return Auth::user()->isAdmin();
        });  

        Gate::define('see-users', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('create', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('store', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('edit', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('update', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('delete', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('destroy', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('export', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('exportByDate', function(){
            return Auth::user()->isAdmin();
        });  

        Gate::define('export-by-date', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('exportByPlace', function(){
            return Auth::user()->isAdmin();
        });
        
        Gate::define('export-by-place', function(){
            return Auth::user()->isAdmin();
        });

        Gate::define('global-mail', function(){
            //return Auth::user()->isAdmin();
            return true;
        });
    }
}
