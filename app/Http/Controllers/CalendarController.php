<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Events\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


class CalendarController extends Controller
{
    //shows the events on the page
    public function index(){

        $event_list = [];
        $calendar = Calendar::addEvents($event_list);
        return view('calendar', compact('calendar'));
    }

}

