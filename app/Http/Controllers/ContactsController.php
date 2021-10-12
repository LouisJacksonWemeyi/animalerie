<?php

namespace App\Http\Controllers;

use App\CategoryContact;
use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryContact::all();
        return view('contacts.index')->with(["categories" => $categories]);

    }   

    public function create($category_id)
    {
        $this->authorize(__FUNCTION__);

        $contact = new Contact;
        $categories = CategoryContact::all();

        return view('contacts.form')->with(["contact" => $contact, "categories" => $categories]);
    }   

    public function store(Request $request, $category_id)
    {
        $this->authorize(__FUNCTION__);
        
        $this->validate($request, Contact::$rules);
        $contact = new Contact;

        $contact->lastname = $request->lastname;
        $contact->firstname = $request->firstname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->note = $request->note;
        $contact->category_contact_id = $category_id;

        $contact->save();

        return redirect()->route("contacts.index"); 
    }   

    public function edit($id)
    {
        $this->authorize(__FUNCTION__);

        $contact = Contact::find($id);
        $categories = CategoryContact::all();

        return view('contacts.form')->with(["contact" => $contact, "categories" => $categories]);
    } 

    public function update(Request $request, $id)
    {
        $this->authorize(__FUNCTION__);

        $this->validate($request, Contact::$rules);
        
        $contact = Contact::find($id);

        $contact->lastname = $request->lastname;
        $contact->firstname = $request->firstname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->note = $request->note;

        $contact->save();

        return redirect()->route("contacts.index"); 
    }
    
    public function destroy($id)
    {
        $this->authorize(__FUNCTION__);

        Contact::findOrFail($id)->delete();
        return redirect()->route("contacts.index");
    }
}
