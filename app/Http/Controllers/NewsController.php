<?php

namespace App\Http\Controllers;

use App\Color;
use App\GetNew;
use App\Mail\NewsMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(__FUNCTION__);
        
        $new = new GetNew;
        $colors = Color::all();
        return view('news.form')->with(["new" => $new, "colors" => $colors]);
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

        $this->validate($request, GetNew::$rules);

        $new = new GetNew;

        $new->title = $request->title;
        $new->content = $request->content;
        $new->display_start = $request->display_start;
        $new->display_end = $request->display_end;
        $new->display_color = $request->display_color;

        $new->save();

        $users = User::where('active', 1)->get();
        $mails = [];
        foreach ($users as $user) {
            $mails[] = $user->email;
        }
        $mails = array_unique($mails);

        foreach ($mails as $mail) {
            Mail::to($mail)->send(new NewsMail($new) );
        }
        return redirect()->route("portal"); 
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

        $new = GetNew::where('id', $id)->first();
        $colors = Color::all();
        return view('news.form')->with(["new" => $new, "colors" => $colors]);
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

        $this->validate($request, GetNew::$rules);
        $new = GetNew::where('id', $id)->first();

        $new->title = $request->title;
        $new->content = $request->content;
        $new->display_start = $request->display_start;
        $new->display_end = $request->display_end;
        $new->display_color = $request->display_color;

        $new->save();
        return redirect()->route("portal");
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
        
        GetNew::findOrFail($id)->delete();
        return redirect()->route("portal");
    }
}
