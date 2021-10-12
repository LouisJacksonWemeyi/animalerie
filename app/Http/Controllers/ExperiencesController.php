<?php

namespace App\Http\Controllers;

use App\EthicalProtocol;
use App\Experience;
use App\ExperienceUser;
use App\Severity;
use App\User;
use Illuminate\Http\Request;

class ExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($protocol_id)
    {
        $protocol = EthicalProtocol::find($protocol_id);
        $experiences = Experience::where('ethical_protocol_id', $protocol_id)->paginate(25);
        return view('experiences.index')->with(["protocol" => $protocol, "experiences" => $experiences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($protocol_id)
    {
        $this->authorize(__FUNCTION__);

        $protocol = EthicalProtocol::where("id", $protocol_id)->first();
        $severities = Severity::get();
        $experience = new Experience;
        return view('experiences.form')->with(["protocol" => $protocol, "severities" => $severities, "experience" => $experience]);
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

        $this->validate($request, Experience::$rules);

        $experience = new Experience;
        $experience->number = $request->number;
        $experience->total_animals = $request->total_animals;
        $experience->ethical_protocol_id = $protocol_id;
        $experience->severity_id = $request->severity_id;
        $experience->note = $request->note;

        $experience->save();

        return redirect()->route("experiences.index", ["protocol_id" => $protocol_id]);
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

        $severities = Severity::get();
        $experience = Experience::find($id);
        $protocol = $experience->ethical_protocol;
        return view('experiences.form')->with(["protocol" => $protocol, "severities" => $severities, "experience" => $experience]);
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

        $this->validate($request, Experience::$rules);

        $experience = Experience::where("id", $id)->first();
        $experience->number = $request->number;
        $experience->total_animals = $request->total_animals;
        $experience->severity_id = $request->severity_id;
        $experience->note = $request->note;

        $experience->save();

        return redirect()->route("experiences.index", ["protocol_id" => $experience->ethical_protocol_id]);
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

        $experience = Experience::findOrFail($id)->delete();
        return redirect()->back();
    }
}
