<?php

namespace App\Http\Controllers;

use App\Mail\GlobalMail;
use App\Mail\NewUserMail;
use App\Rank;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('see-users');

        //$users = User::paginate(25); Jackson modif: ancienne version mis en commentaire à fin de permettre un tri par ordre alphabétique
        $users = User::orderBy('lastname', 'asc')->paginate(25);//Jackson modif: ajouter pour permettre un tri par ordre alphabétique
        return view('users.index')->with(['users' => $users]);
    }
 
    /**
     * Dislay the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::check()){    
            return redirect('/');
        }
        return view('login');

    }

    /**
     * Attempt to connect the user, if fails go back to login.
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request)
    {
        $remember = $request->get('remember');
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $remember))
        {
            return redirect('/');
        }

        return back()->withInput()->with('message', 'Connexion impossible.'); 
    }

    /**
     * Logout the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $user = new User;
        $ranks = Rank::all();
        return view('users.form')->with(['user' => $user, 'ranks' => $ranks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, User::$rules);
        
        $credentials = ["lastname" => $request->lastname, 
                        "firstname" => $request->firstname, 
                        "email" => $request->email, 
                        "rank_id" => $request->rank, 
                        "password" => str_random(8)];

        $clear_pass = $credentials['password'];

        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::create($credentials);
        Mail::to($user->email)->send(new NewUserMail($user, $clear_pass) );

        return redirect()->route('users.index');
    } 


    /**
     * Display the logged user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itself()
    {
        $user = Auth::user();
        return view('users.itself')->with(["user" => $user]);
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, User::$rules_password);

        $user = Auth::user();
        $user->fill([
            'password' => Hash::make($request->new_password)
        ])->save();

        return redirect()->back()->with("success","Mot de passe modifié avec succés.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize(__FUNCTION__);

        $user = User::find($id);
        $ranks = Rank::all();
        return view('users.form')->with(['user' => $user, 'ranks' => $ranks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, User::$rules_update);

        $user = User::find($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        if($id != Auth::id()){
            $user->rank_id = $request->rank;
        }

        if($request->new_password){
            $user->fill([
                'password' => Hash::make($request->new_password)
            ]);
        }

        $user->save();

        return redirect()->route('users.index');
    }

    public function globalMail(Request $request)
    {
        $this->authorize('global-mail');

        $users = User::where('active', 1)->get();
        $mails = [];

        foreach ($users as $user) {
            $mails[] = $user->email;
        }
        $mails = array_unique($mails);

        foreach ($mails as $mail) {
            Mail::to($mail)->send(new GlobalMail($request) );
        }

        return json_encode(["response" => "success"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $this->authorize('update');

        if ($id !== Auth::id()) {
            User::where('id', $id)->update(['active' => 1]);
        }
        return redirect()->route('users.index');

    }    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $this->authorize('update');

        if ($id != Auth::id()) {
            User::where('id', $id)->update(['active' => 0]);
        }
        return redirect()->route('users.index');

    }

    public function forgoter()
    {
        //$user = Auth::user();
        //return view('users.itself')->with(["user" => $user]);
        $user = new User;
        //$ranks = Rank::all();
        //return view('users.formMotDePassOublier')->with(['user' => $user, 'ranks' => $ranks]);
        return view('users.formMotDePassOublier')->with(['user' => $user]);

    }

    public function forgotpost(Request $request)
    {
        //$this->validate($request, User::$rules_password);
        //$user=DB::table('users')->where('email', '=', $request->email)->get();
        if ($request->password){
           // $this->validate($request, User::$rules_password);

            //$user = Auth::user();
            $user = User::All()->where('email',$request->email);
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
    
            return redirect()->back()->with("success","Mot de passe modifié avec succés.");
        }else{
        $user = User::All()->where('email',$request->email);
        //return view('users.show')->with(["user" => $user]);
        foreach($user as $user){

        //$user = User::find(1);
        
        if($user->email == $request->email){
        return view('users.itself')->with(["user" => $user]);
        //return redirect()->route('resetpassform');
        }
    }

        return redirect()->back()->with("danger","Il n'existe pas de compte lié à cette adresse mail, veuillez contacter l'une des administratrices du portail $request->password");}
        
    //}
    }
   /*  public function itself()
    {
        $user = Auth::user();
        return view('users.itself')->with(["user" => $user]);
    }  */  

     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(__FUNCTION__);

        User::findOrFail($id)->delete();
        return redirect()->route('users.index');

    }
}
