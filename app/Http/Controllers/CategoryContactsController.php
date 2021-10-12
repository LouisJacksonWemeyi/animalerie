<?php

namespace App\Http\Controllers;

use App\CategoryContact;
use App\Contact;
use Illuminate\Http\Request;

class CategoryContactsController extends Controller
{

    public function create()
    {
        $this->authorize(__FUNCTION__);
        
    	$category = new CategoryContact;
        return view('category_contacts.form')->with(["category" => $category]);
    }   

    public function store(Request $request)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, CategoryContact::$rules);

    	$category = new CategoryContact;

    	$category->name = $request->name;

    	$category->save();
    	return redirect()->route("contacts.index"); 
    }   

    public function edit($id)
    {
        $this->authorize(__FUNCTION__);

    	$category = CategoryContact::find($id);
        return view('category_contacts.form')->with(["category" => $category]);
    } 

    public function update(Request $request, $id)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, CategoryContact::$rules);
        
    	$category = CategoryContact::find($id);

    	$category->name = $request->name;

    	$category->save();
    	return redirect()->route("contacts.index"); 
    }

    public function destroy($id)
    {
        $this->authorize(__FUNCTION__);

        CategoryContact::findOrFail($id)->delete();
        return redirect()->route("contacts.index");
    }
}
