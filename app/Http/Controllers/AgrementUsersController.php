<?php

namespace App\Http\Controllers;

use App\Agrement;
use App\AgrementUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgrementUsersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($agrement_id)
    {
        $this->authorize(__FUNCTION__);

        $agrement_user = new AgrementUser;
        $agrement = Agrement::find($agrement_id);
        $users = User::all();

        return view('agrement_users.form')->with(["agrement_user" => $agrement_user, "agrement" => $agrement, "users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $agrement_id)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, AgrementUser::$rules);

        $agrement_user = new AgrementUser;

        $agrement_user->agrement_id = $agrement_id;
        $agrement_user->user_id = $request->user_id;

        $agrement_user->save();
        
        return redirect()->route("agrements.index");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(__FUNCTION__);
        
        $agrement = AgrementUser::findOrFail($id)->delete();

        return redirect()->route("agrements.index");

    }
}
