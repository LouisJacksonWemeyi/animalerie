<?php

namespace App\Http\Controllers;

use App\Text;
use Illuminate\Http\Request;

class TextsController extends Controller
{

    public function edit($id)
    {
        $text = Text::find($id);
        return view("texts.form")->with(["text" => $text]);
    }   
      
    public function update(Request $request, $id)
    {
        $this->authorize(__FUNCTION__);
        
        $this->validate($request, Text::$rules);

        $text = Text::find($id);

        $text->text = $request->text;

        $text->save();

        if ($text->id == 1) {
            return redirect()->route("links.index");
        }
        elseif($text->id == 2){
            return redirect()->route("contacts.index");
        }else{
            return redirect()->route("portal");
        }

    }   

}
