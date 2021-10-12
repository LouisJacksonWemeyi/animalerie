<?php

namespace App\Http\Controllers;

use App\EthicalProtocol;
use App\EthicalProtocolUser;
use App\User;
use Illuminate\Http\Request;

class ProtocolUsersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($protocol_id)
    {
        $this->authorize(__FUNCTION__);

        $protocol_user = new EthicalProtocolUser;
        $protocol = EthicalProtocol::find($protocol_id);
        $users = $protocol->agrement->users;

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
        $this->authorize(__FUNCTION__);

        $this->validate($request, EthicalProtocolUser::$rules);

            $protocol_user = new EthicalProtocolUser;

            $protocol_user->ethical_protocol_id = $protocol_id;
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
        $this->authorize(__FUNCTION__);
        
        $protocol = EthicalProtocolUser::findOrFail($id)->delete();

        return redirect()->route("protocols.index");

    }
}
