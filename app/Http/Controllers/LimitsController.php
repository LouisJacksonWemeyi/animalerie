<?php

namespace App\Http\Controllers;

use App\CategoryContact;
use App\Color;
use App\Contact;
use App\Limit;
use Illuminate\Http\Request;

class LimitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limits = Limit::all();
        return view('limits.index')->with(["limits" => $limits]);

    }   

    public function edit($id)
    {
        $this->authorize(__FUNCTION__);

        $limit = Limit::find($id);
        $colors = Color::all();

        return view('limits.form')->with(["limit" => $limit, 'colors' => $colors]);
    } 

    public function update(Request $request, $id)
    {
        $this->authorize(__FUNCTION__);
        
        $this->validate($request, Limit::$rules);

        $limit = Limit::find($id);

        $limit->extrem_down = $request->extrem_down;
        $limit->down = $request->down;
        $limit->up = $request->up;
        $limit->extrem_up = $request->extrem_up;
        $limit->normal_color = $request->normal_color;
        $limit->color = $request->color;
        $limit->extrem_color = $request->extrem_color;

        $limit->save();

        return redirect()->route("limits.index"); 
    }
    
}
