<?php

namespace App\Http\Controllers;

use App\EthicalProtocol;
use App\Experience;
use App\Severity;
use App\Specie;
use App\StockAnimal;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockAnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = StockAnimal::paginate(25);
        return view('animals.index')->with(["animals" => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $animal = new StockAnimal;
        $suppliers = Supplier::all();
        $experiences = Experience::all();
        $species = Specie::all();

        return view('animals.form')->with(["animal" => $animal, "suppliers" => $suppliers, "experiences" => $experiences, "species" => $species]);
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

        $animal = new StockAnimal;

        $animal->number_in  = $request->number_in;
        $animal->number_out = $request->number_out;
        $animal->delivery_number = $request->delivery_number;
        $animal->strain = $request->strain;
        $animal->supplier_id = $request->supplier_id;
        $animal->specie_id = $request->specie_id;
        $animal->experience_id   = $request->experience_id;
        $animal->user_id = Auth::user()->id;

        $animal->save();

        return redirect()->route("animals.index");
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

        $animal = StockAnimal::where("id", $id)->first();
        $suppliers = Supplier::all();
        $experiences = Experience::all();
        $species = Specie::all();

        return view('animals.form')->with(["animal" => $animal, "suppliers" => $suppliers, "experiences" => $experiences, "species" => $species]);
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
        
        $animal = StockAnimal::where("id", $id)->first();

        $animal->number_in  = $request->number_in;
        $animal->number_out = $request->number_out;
        $animal->delivery_number = $request->delivery_number;
        $animal->strain = $request->strain;
        $animal->supplier_id = $request->supplier_id;
        $animal->specie_id = $request->specie_id;
        $animal->experience_id   = $request->experience_id;

        $animal->save();

        return redirect()->route("animals.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
