<?php

namespace App\Http\Controllers;

use App\ApplicationDomain;
use App\Place;
use App\Reservation;
use App\Supply;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //jackson modif: renvoie la page reservations.index si l'utilisateur est un admin sinon reservations.indexUtilisateur
        $user = Auth::user();
        if ($user->can('isadmin')){
            $reservations = Reservation::paginate(25);
            return view('reservations.index')->with(["reservations" => $reservations]);
        }else{
            $reservations = Reservation::paginate(25);
            return view('reservations.indexUtilisateur')->with(["reservations" => $reservations]);
        }
        /* 
        ancienne version mis en commentaire par Jackson 
        $reservations = Reservation::paginate(25);
        return view('reservations.index')->with(["reservations" => $reservations]); */
    }

    /**
     * Display create form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users de créer une réservation 

        $reservation = new Reservation;

        $supplies = Supply::all(); // on récupere toutes les founitures de la BD

        $supplies = $supplies->where('type', 'materiel'); // on filtre pour obtenir que du matériel 
        $places = Place::all();
        return view('reservations.form')->with(["reservation" => $reservation, "supplies" => $supplies, "places" => $places]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users de stocker dans la BD une réservation 

        $this->validate($request, Reservation::$rules);

        $taken_reservations = Reservation::where('supply_id', $request->supply_id)->where(function ($q) use ($request) {
            $q->whereBetween('start', [$request->start, $request->end])->whereBetween('end', [$request->start, $request->end])
            ->orWhere([['start', '<=', $request->start], ['end', '>=', $request->start]]);
        })->get();

        $supply = Supply::find($request->supply_id);

        $sum_taken = $taken_reservations->sum('number');
        $available_stock = $supply->stock - $sum_taken;

        if (($available_stock - $request->number) < 0) {
            session()->flash('error',"Impossible de réserver cette quantité de fourniture pour ces dates.<br/>" . $available_stock . " " . str_plural($supply->unit->name, $available_stock) . " de " . $supply->name . " " . str_plural("disponible", $available_stock) . " pour ces dates");
            return redirect()->back()->withInput(Input::all());
        }

        $reservation = new Reservation;

        $reservation->number = $request->number;
        $reservation->start = $request->start;
        $reservation->end = $request->end;
        $reservation->place_id = $request->place_id;
        $reservation->supply_id = $request->supply_id;
        $reservation->Remarques = $request->Remarques;
        $reservation->user_id = Auth::id();

        $reservation->save();
        return redirect()->route("reservations.index");
    }

    /**
     * Display edit form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users d'editer une réservation 

        $reservation = Reservation::find($id);
        $supplies = Supply::all(); // on récupere toutes les founitures de la BD
        $supplies = $supplies->where('type', 'materiel'); // on filtre pour obtenir que du matériel 
        $places = Place::all();
        return view('reservations.form')->with(["reservation" => $reservation, "supplies" => $supplies, "places" => $places]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users de mettre à our une réservation 

        $this->validate($request, Reservation::$rules);

        // Ajouter par Jackson mais développé par Jonathan, pour conttroller la mise à jour d'une reservation 
        $taken_reservations = Reservation::where('supply_id', $request->supply_id)->where(function ($q) use ($request) {
            $q->whereBetween('start', [$request->start, $request->end])->whereBetween('end', [$request->start, $request->end])
            ->orWhere([['start', '<=', $request->start], ['end', '>=', $request->start]]);
        })->get();

        $supply = Supply::find($request->supply_id);

        $sum_taken = $taken_reservations->sum('number');
        $available_stock = $supply->stock - $sum_taken;

        if (($available_stock - $request->number) < 0) {
            session()->flash('error',"Impossible de réserver cette quantité de fourniture pour ces dates.<br/>" . $available_stock . " " . str_plural($supply->unit->name, $available_stock) . " de " . $supply->name . " " . str_plural("disponible", $available_stock) . " pour ces dates");
            return redirect()->back()->withInput(Input::all());
        }
        // fin ajout Jackson
        $reservation = Reservation::find($id);

        $reservation->number = $request->number;
        $reservation->start = $request->start;
        $reservation->end = $request->end;
        $reservation->place_id = $request->place_id;
        $reservation->supply_id = $request->supply_id;
        $reservation->Remarques = $request->Remarques;

        $reservation->save();
        return redirect()->route("reservations.index");
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
        
        Reservation::findOrFail($id)->delete();
        return redirect()->route("reservations.index");
    }
}
