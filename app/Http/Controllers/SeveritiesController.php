<?php

namespace App\Http\Controllers;

use App\Severity;
use Illuminate\Http\Request;

class SeveritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $severities = Severity::paginate(25);
        $severity = new Severity;
        return view('severities.index')->with(['severity' => $severity, 'severities' => $severities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $severity = new Severity;
        return view("severities.form")->with(["severity" => $severity]);
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

        $this->validate($request, Severity::$rules);
        $severity = new Severity;

        $severity->title = $request->title;

        $severity->save();
        return redirect()->route("severities.index");

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

        $severity = Severity::find($id);
        return view("severities.form")->with(["severity" => $severity]);
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

        $this->validate($request, Severity::$rules);
        
        $severity = Severity::find($id);

        $severity->title = $request->title;

        $severity->save();
        return redirect()->route("severities.index");    
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
        
        Severity::findOrFail($id)->delete();
        return redirect()->route("severities.index");    
        
    }
}
