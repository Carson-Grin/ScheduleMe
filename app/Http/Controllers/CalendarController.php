<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Events\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


class CalendarController extends Controller
{
    //shows the events on the page
    public function index(){

	$events = DB::table('events')->where('email',Auth::user()->email)->get();
	$events_list = [];
	
	foreach ($events as $event) {
		
		if (strlen($event->name) > 30)
		$event->name = substr($event->name, 0, 20)."\n".substr($event->name, 21, strlen($event->name) - 20);
	
	$desc = $event->name."\nfrom ".$event->start_time." to ".$event->end_time;

		$event_list[] = Calendar::event(
			$desc,
			true,
			$event->start_date,
			$event->end_date
		);
	}

	$calendar = Calendar::addEvents($event_list);
        return view('calendar', compact('calendar'));
    }

}

