<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(25);
        return view("suppliers.index")->with(["suppliers" => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);

        $supplier = new Supplier;
        return view("suppliers.form")->with(["supplier" => $supplier]);
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

        $supplier = new Supplier;

        $supplier->name = $request->name;
        $supplier->contact = $request->contact;

        $supplier->save();
        return redirect()->route("suppliers.index");
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

        $supplier = Supplier::where("id", $id)->first();
        return view("suppliers.form")->with(["supplier" => $supplier]);
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

        $supplier = Supplier::where("id", $id)->first();

        $supplier->name = $request->name;
        $supplier->contact = $request->contact;

        $supplier->save();
        return redirect()->route("suppliers.index");
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
        
        Supplier::findOrFail($id)->delete();
        return redirect()->route("suppliers.index");
    }
}
