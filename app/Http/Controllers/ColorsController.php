<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::paginate(25);

        return view('colors.index')->with(["colors" => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $color = new Color;

        return view('colors.form')->with(["color" => $color]);
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

        $this->validate($request, Color::$rules);
        $color = new Color;

        $color->color = $request->color;
        $color->alias = $request->alias;

        $color->save();
        
        
        return redirect()->route("colors.index");
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

        $color = Color::find($id);

        return view('colors.form')->with(["color" => $color]);
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

        $this->validate($request, Color::$rules_update);

        $color = Color::find($id);

        $color->color = $request->color;
        $color->alias = $request->alias;

        $color->save();
        
        
        return redirect()->route("colors.index");
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
        
        Color::findOrFail($id)->delete();

        return redirect()->route("colors.index");

    }
}
