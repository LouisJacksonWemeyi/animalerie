<?php

namespace App\Http\Controllers;

use App\Color;
use App\EthicalProtocol;
use App\Event;
use App\User;
use App\Mail\EvenementMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //jackson modif: renvoie la page events.index si l'utilisateur est un admin sinon events.indexUtilisateur
        $user = Auth::user();
        if ($user->can('isadmin')){
            $events = Event::paginate(25);
            return view('events.index')->with(["events" => $events]);
        }else{
            $events = Event::paginate(25);
            return view('events.indexUtilisateur')->with(["events" => $events]);
        }
        /* 
        ancienne version mis en commentaire par Jackson
        $events = Event::paginate(25);
        return view('events.index')->with(["events" => $events]); */
    }

    /**
     * Give a events json list for the calendar on portal
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $events = Event::whereBetween('date', [$request->start, $request->end])->get();
        $formated_events = [];
        foreach ($events as $key => $event) {
            $formated_events[$key]['id'] = $event->id;
            $formated_events[$key]['start'] = $event->date->format('Y-m-d\TH:i:sO');
            $formated_events[$key]['allDay'] = true;
            $formated_events[$key]['title'] = $event->title;
            $formated_events[$key]['color'] = $event->display_color;
            $formated_events[$key]['description'] = $event->title . "<br/><br/>" . $event->description;

        }
        return json_encode($formated_events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users de créer un évenement 

        $event = new Event;
        $protocols = EthicalProtocol::get();
        $colors = Color::all();
        return view('events.form')->with(["event" => $event, "protocols" => $protocols, "colors" => $colors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users d'enregistrer un évenement
        $user = Auth::user();
        $this->validate($request, Event::$rules);
        $event = new Event;

        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->display_color = $request->display_color;
        $event->ethical_protocol_id = $request->ethical_protocol_id;
        $event->user_id = $user->id;

        $event->save();

        $users = User::where('active', 1)->get();
        $mails = [];
        foreach ($users as $user) {
            $mails[] = $user->email;
        }
        $mails = array_unique($mails);

        foreach ($mails as $mail) {
            Mail::to($mail)->send(new EvenementMail($event) );
        }
        /* Mail::to('ozgurkatar@hotmail.com')->send(new EvenementMail($event) ); */
        return redirect()->route("events.index");    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users d'editer un évenement

        $event = Event::where("id", $id)->first();
        $protocols = EthicalProtocol::get();
        $colors = Color::get();
        return view('events.form')->with(["event" => $event, "protocols" => $protocols, "colors" => $colors]);
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
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre aux users de mettre à jour un évenement

        $this->validate($request, Event::$rules);

        $event = Event::where("id", $id)->first();
        
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->display_color = $request->display_color;
        $event->ethical_protocol_id = $request->ethical_protocol_id;

        $event->save();
        return redirect()->route("events.index");    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize(__FUNCTION__); Jackson modif pour permettre à un user de supprimer un evenement
        
        Event::findOrFail($id)->delete();
        return redirect()->route("events.index");
    }
}
