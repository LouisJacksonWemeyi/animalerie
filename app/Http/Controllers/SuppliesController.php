<?php

namespace App\Http\Controllers;

use App\Supply;
use App\Unit;
use Illuminate\Http\Request;

class SuppliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supply::orderBy('name', 'asc')->with("stock_registries")->paginate(25);
        return view("supplies.index")->with(["supplies" => $supplies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre à un user de créer une fourniture

        $supply = new Supply;
        $units = Unit::get();
        
        return view("supplies.form")->with(["supply" => $supply, "units" => $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre à un user de stocker une fourniture

        $this->validate($request, Supply::$rules);

        $supply = new Supply;

        $supply->name = $request->name;
        $supply->unit_id = $request->unit_id;
        $supply->type = $request->type;

        $supply->save();
        return redirect()->route("supplies.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre à un user d'éditer une fourniture

        $supply = Supply::where("id", $id)->first();
        $units = Unit::get();
        return view("supplies.form")->with(["supply" => $supply, "units" => $units]);
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
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre à un user de mettre à jour une fourniture

        $this->validate($request, Supply::$rules);
        
        $supply = Supply::where("id", $id)->first();

        $supply->name = $request->name;
        $supply->unit_id = $request->unit_id;
        $supply->type = $request->type;

        $supply->save();
        return redirect()->route("supplies.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize(__FUNCTION__); jackson modif pour permettre à un user de supprimer une fourniture
        
        Supply::findOrFail($id)->delete();
        return redirect()->route("supplies.index");
    }
}
