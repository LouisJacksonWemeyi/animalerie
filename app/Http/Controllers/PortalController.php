<?php

namespace App\Http\Controllers;

use App\ApplicationDomain;
use App\Cage;
use App\Event;
use App\GetNew;
use App\InfoPlace;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = GetNew::toDisplay()->paginate(25);

        return view('portal')->with(["news" => $news]);
    }

}
