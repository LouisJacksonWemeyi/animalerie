<?php

namespace App\Http\Controllers;

use App\Agrement;
use App\Specie;
use App\StockAnimal;
use Illuminate\Http\Request;

class RegistriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($agrement_id, $specie_id)
    {
        $agrement = Agrement::where("id", $agrement_id)->first();
        $specie = Specie::where("id", $specie_id)->first();
        $registries = StockAnimal::where("specie_id", $specie_id)->get();

        return view('registries.index')->with(["registries" => $registries, "agrement" => $agrement, "agrement" => $agrement, "specie" => $specie]);
    }

}
