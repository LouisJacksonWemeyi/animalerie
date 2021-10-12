<?php

namespace App\Http\Controllers;

use App\Cage;
use App\CageType;
use App\Experience;
use Illuminate\Http\Request;

class CagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($experience_id)
    {
        $this->authorize(__FUNCTION__);

        $cage = new Cage;
        $experience = Experience::where("id", $experience_id)->first();
        $cage_types = CageType::get();
        return view("cages.form")->with(["cage_types" => $cage_types, "experience" => $experience,"cage" => $cage]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $experience_id)
    {
        $this->authorize(__FUNCTION__);

        $cage = new Cage;
        $experience = Experience::where("id", $experience_id)->first();

        $cage->name = $request->name;
        if (!empty($request->last_cleaning)) {
            $cage->last_cleaning = $request->last_cleaning;
        }else{
            $cage->last_cleaning = now();
        }
        $cage->experience_id = $experience_id;
        $cage->cage_type_id = $request->cage_type_id;

        $cage->save();

        return redirect()->route("experiences.index", ["protocol_id" => $experience->ethical_protocol_id]);

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

        $cage = Cage::where("id", $id)->first();
        $experience = Experience::where("id", $cage->experience->id)->first();
        $cage_types = CageType::get();
        return view("cages.form")->with(["cage_types" => $cage_types, "experience" => $experience,"cage" => $cage]);
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

        $cage = Cage::where("id", $id)->first();
        $experience = Experience::where("id", $cage->experience->id)->first();

        $cage->name = $request->name;
        $cage->last_cleaning = $request->last_cleaning;
        $cage->experience_id = $experience->id;
        $cage->cage_type_id = $request->cage_type_id;

        $cage->save();

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
        
        $cage = Cage::findOrFail($id)->first();
        $experience = Experience::where("id", $cage->experience->id)->first();

        $cage->delete();

        return redirect()->route("experiences.index", ["protocol_id" => $experience->ethical_protocol_id]);
    }
}
