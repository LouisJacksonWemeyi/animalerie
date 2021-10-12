<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = new Place;
        $places = Place::paginate(25);
        return view('places.index')->with(['place' => $place, 'places' => $places]);
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

        $this->validate($request, Place::$rules);
        
        $place = new Place;

        $place->name = $request->name;

        $place->save();
        return redirect()->route("places.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize(__FUNCTION__);

        $place = Place::find($id);

        return view('places.form')->with(['place' => $place]);
    }


    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, Place::$rules);

        $place = Place::find($id);

        $place->name = $request->name;

        $place->save();
        return redirect()->route("places.index");
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
        
        Place::findOrFail($id)->delete();
        return redirect()->route("places.index");
    }
}
