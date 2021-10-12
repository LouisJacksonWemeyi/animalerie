<?php

namespace App\Http\Controllers;

use App\EthicalProtocol;
use App\EthicalProtocolArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EthicalProtocolArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($protocol_id)
    {
        $protocol = EthicalProtocol::find($protocol_id);
        $archives = EthicalProtocolArchive::where('ethical_protocol_id', $protocol_id)->orderBy('date', 'desc')->paginate(25);

        return view('protocol_archives.index')->with(['protocol' => $protocol, 'archives' => $archives]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($protocol_id)
    {
        $this->authorize(__FUNCTION__);

        $protocol = EthicalProtocol::find($protocol_id);
        $archive = new EthicalProtocolArchive;

        return view('protocol_archives.form')->with(['protocol' => $protocol, 'archive' => $archive]);
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

        $this->validate($request, EthicalProtocolArchive::$rules);
        $archive = new EthicalProtocolArchive;

        $archive->note = $request->note;
        $archive->date = $request->date;
        $archive->ethical_protocol_id = $protocol_id;
        $archive->user_id = Auth::id();
        $archive->save();

        $protocol = EthicalProtocol::find($protocol_id);

        $protocol->total_animals = $request->total_animals;
        $protocol->date_end = $request->date_end;
        $protocol->uploaded = null;

        $protocol->save();

        return redirect()->route("protocol.archives.index", ["protocol_id" => $protocol_id]);
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

        $archive = EthicalProtocolArchive::find($id);
        $protocol = EthicalProtocol::find($archive->ethical_protocol_id);

        return view('protocol_archives.form')->with(['archive' => $archive, 'protocol' => $protocol]);
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
        
        $this->validate($request, EthicalProtocolArchive::$rules);
        
        $archive = EthicalProtocolArchive::find($id);

        $archive->note = $request->note;
        $archive->date = $request->date;

        $archive->save();

        $protocol = EthicalProtocol::find($archive->ethical_protocol_id);

        $protocol->total_animals = $request->total_animals;
        $protocol->date_end = $request->date_end;

        $protocol->save();
        return redirect()->route("protocol.archives.index", ["protocol_id" => $protocol->id]);
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
        
       $archive = EthicalProtocolArchive::findOrFail($id);

       $protocol_id = $archive->ethical_protocol_id;

       $archive->delete();

       return redirect()->route('protocol.archives.index', ['protocol_id' => $protocol_id]);
    }
}
