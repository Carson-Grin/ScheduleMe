<?php

namespace App\Http\Controllers;

use DateTime;
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
<<<<<<< HEAD
		$event->name = substr($event->name, 0, 20)."\n".substr($event->name, 21, strlen($event->name) - 20);
	
		$desc = $event->name."\nfrom ".$event->start_time." to ".$event->end_time;
		
=======
			$event->name = substr($event->name, 0, 20)."\n".substr($event->name, 21, strlen($event->name) - 20);

>>>>>>> 6d5955b9ae6f18c945be46c94434d52559d7d751
		$event_list[] = Calendar::event(
			$event->name,
			false,
			new DateTime($event->start_date.$event->start_time),
			new DateTime($event->start_date.$event->end_time)
		);
	}

	$calendar;
	if (empty($event_list))
	{
		$empty_list = [];
		$calendar = Calendar::addEvents($empty_list);
	}	
	else
	{
		$calendar = Calendar::addEvents($event_list)
				->setOptions([
					'selectable' => true,
				])
				->setCallbacks([
					'eventClick' => 'function(event) { alert(event.title); }'
				]);
	}

        return view('calendar', compact('calendar'));
    }

}

