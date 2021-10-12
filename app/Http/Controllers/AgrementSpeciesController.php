<?php

namespace App\Http\Controllers;

use App\Agrement;
use App\AgrementSpecie;
use App\Specie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgrementSpeciesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($agrement_id)
    {
        $this->authorize(__FUNCTION__);

        $agrement_specie = new AgrementSpecie;
        $agrement = Agrement::find($agrement_id);
        $species = Specie::all();

        return view('agrement_species.form')->with(["agrement_specie" => $agrement_specie, "agrement" => $agrement, "species" => $species]);
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

        $this->validate($request, AgrementSpecie::$rules);

        $agrement_specie = new AgrementSpecie;

        $agrement_specie->agrement_id = $agrement_id;
        $agrement_specie->specie_id = $request->specie_id;
        $agrement_specie->url_file = $request->url_file;

        $agrement_specie->save();
        
        return redirect()->route("agrements.index");
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

        $agrement_specie = AgrementSpecie::find($id);
        $species = Specie::all();

        return view('agrement_species.edit')->with(["agrement_specie" => $agrement_specie, "species" => $species]);
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

        $this->validate($request, AgrementSpecie::$rules_update);

        $agrement_specie = AgrementSpecie::find($id);

        $agrement_specie->url_file = $request->url_file;

        $agrement_specie->save();
        
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

        $agrement = AgrementSpecie::findOrFail($id)->delete();

        return redirect()->route("agrements.index");

    }
}
