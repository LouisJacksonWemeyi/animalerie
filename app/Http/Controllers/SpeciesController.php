<?php

namespace App\Http\Controllers;

use App\Specie;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Specie::paginate(25);
        $specie = new Specie;

        return view('species.index')->with(['specie' => $specie, 'species' => $species]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $specie = new Specie;

        return view('species.form')->with(['specie' => $specie]);
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

        $this->validate($request, Specie::$rules);
        $specie = new Specie;

        $specie->name = $request->name;

        $specie->save();

        return redirect()->route('species.index');
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

        $specie = Specie::find($id);

        return view('species.form')->with(['specie' => $specie]);
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

        $this->validate($request, Specie::$rules);
        $specie = Specie::find($id);

        $specie->name = $request->name;

        $specie->save();

        return redirect()->route('species.index');
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
        
        Specie::findOrFail($id)->delete();

        return redirect()->route('species.index');
    }
}
