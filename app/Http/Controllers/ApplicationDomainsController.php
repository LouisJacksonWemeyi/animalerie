<?php

namespace App\Http\Controllers;

use App\ApplicationDomain;
use Illuminate\Http\Request;

class ApplicationDomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = ApplicationDomain::paginate(25);
        return view('domains.index')->with(["domains" => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $domain = new ApplicationDomain;

        return view("domains.form")->with(["domain" => $domain]);
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

        $this->validate($request, ApplicationDomain::$rules);
        $domain = new ApplicationDomain;

        $domain->title = $request->title;

        $domain->save();
        return redirect()->back();
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

        $domain = ApplicationDomain::find($id);

        return view("domains.form")->with(["domain" => $domain]);
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

        $this->validate($request, ApplicationDomain::$rules);

        $domain = ApplicationDomain::find($id);

        $domain->title = $request->title;

        $domain->save();
        return redirect()->route("domains.index");

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
        
        ApplicationDomain::findOrFail($id)->delete();
        return redirect()->route("domains.index");
    }
}
