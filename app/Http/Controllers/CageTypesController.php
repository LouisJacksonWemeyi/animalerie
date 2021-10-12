<?php

namespace App\Http\Controllers;

use App\CageType;
use Illuminate\Http\Request;

class CageTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cage_types = CageType::paginate(25);
        return view("cage_types.index")->with(["cage_types" => $cage_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $cage_type = new CageType;
        return view("cage_types.form")->with(["cage_type" => $cage_type]);
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

        $cage_type = new CageType;

        $cage_type->name = $request->name;
        $cage_type->capacity = $request->capacity;
        $cage_type->save();

        return redirect()->route("cage.types.index");

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

        $cage_type = CageType::where("id", $id)->first();
        return view("cage_types.form")->with(["cage_type" => $cage_type]);
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
        
        $cage_type = CageType::where("id", $id)->first();

        $cage_type->name = $request->name;
        $cage_type->capacity = $request->capacity;
        $cage_type->save();

        return redirect()->route("cage.types.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cage = CageType::findOrFail($id)->delete();

        return redirect()->route("cage.types.index");
    }
}
