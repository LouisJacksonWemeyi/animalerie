<?php

namespace App\Http\Controllers;

use App\Link;
use App\Text;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::paginate(25);
        $link = new Link;
        $text = Text::where("id", 1)->first();

        return view('links.index')->with(['link' => $link, 'links' => $links, 'text' => $text]);
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

        $this->validate($request, Link::$rules);

        $link = new Link;

        $link->title = $request->title;
        $link->url = $request->url;

        $link->save();
        return redirect()->route("links.index");
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

        $link = Link::find($id);

        return view('links.form')->with(['link' => $link]);
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

        $this->validate($request, Link::$rules);
        
        $link = Link::find($id);

        $link->title = $request->title;
        $link->url = $request->url;

        $link->save();
        return redirect()->route("links.index");
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
        
        Link::findOrFail($id)->delete();
        return redirect()->route("links.index");
    }
}
