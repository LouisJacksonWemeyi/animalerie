<?php

namespace App\Http\Controllers;

use App\EthicalProtocolUser;
use App\EthicalProtocolArchive;
use Illuminate\Support\Facades\Auth;
use App\EthicalProtocol;
use App\User;
use Illuminate\Http\Request;

class ProtocolUserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($protocol_id) 
    {  
        $protocol_user = new EthicalProtocolUser;
        $protocol = EthicalProtocol::find($protocol_id);
        $users = User::all();

        return view('protocol_users.form')->with(["protocol_user" => $protocol_user, "protocol" => $protocol, "users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $protocol_id)
    {

        $check_protocol_user = EthicalProtocolUser::where([
                                ['ethical_protocol_id', $protocol_id], 
                                ['user_id', $request->user_id]
                                ])->first();

        if (!isset($check_protocol_user)) {
            $protocol_user = new EthicalProtocolUser;

            $protocol_user->ethical_protocol_id = $protocol_id;
            $protocol_user->user_id = $request->user_id;

            $protocol_user->save();
        }

        //ajout par jackson pour l'historique
        
        $archive = new EthicalProtocolArchive;

        
        $archive->note = " Ajout d'un nouvel utilisateur, ".User::find($request->user_id)->name.", par ".User::find(Auth::id())->name;
        
        $archive->date = date("Y-m-d H:i:s", time());
        $archive->ethical_protocol_id = $protocol_id;
        $archive->user_id = Auth::id();
        $archive->save();
        
        return redirect()->route("protocols.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $protocol_user = EthicalProtocolUser::find($id);
        $protocol = EthicalProtocol::find($protocol_user->ethical_protocol_id);
        $users = User::all();

        return view('protocol_users.form')->with(["protocol_user" => $protocol_user, "protocol" => $protocol, "users" => $users]);
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
        $protocol_user = EthicalProtocolUser::find($id);

        $protocol_user->user_id = $request->user_id;

        $protocol_user->save();
        
        return redirect()->route("protocols.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $protocol = EthicalProtocolUser::findOrFail($id)->delete();

        return redirect()->route("protocols.index");

    }
}
