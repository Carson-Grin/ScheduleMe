<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Events\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

use App\Events;

class EventsController extends Controller
{
    //shows the events on the page
    public function index(){


		
        $events = DB::table('events')->where('email',Auth::user()->email)->get();
	    $event_list = [];
	
	    foreach ($events as $event) {
		
		if (strlen($event->name) > 30)
		$event->name = substr($event->name, 0, 20)."\n".substr($event->name, 21, strlen($event->name) - 20);
	
	    $desc = $event->name."\nfrom ".$event->start_time." to ".$event->end_time;

		$event_list[] = array(
			$desc,
			$event->id,
			$event->name,
			true,
			$event->start_date,
			$event->end_date
		);
	}

		
		
        return view('events',compact('event_list')); 
    }
    //adds event and makes sure all data entries are filled out
    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'event_name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            //'end_date' => 'required',
	        'end_time' => 'required'
        ]);

	if($request->start_time >= $request->end_time or $request->start_date < substr(Carbon::now()->toDateTimeString(), 0, 10) or $validator->fails()){
            \Session::flash('warning', 'Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
		}

	
		
	

	/*
	$event = new Events;
	$event->name = $request['event_name'];
	$event->start_date = $request['start_date'];
	$event->end_date = $request['end_date'];
	$event->start_time = $request['start_time'];
	$event->end_time = $request['end_time'];
	$event->email = Auth::user()->email;
	 */

	DB::table('events')->insertGetId(['name' => $request['event_name'],
                      'start_date' => $request['start_date'],
                      'end_date' => $request['start_date'],
					  'start_time' => $request['start_time'],
                      'end_time' => $request['end_time'],
					  'email' => Auth::user()->email,
				        ]);

        \Session::flash('success', 'Event has been added to your calendar.');
        return Redirect::to('/events');
	}
	
	public function delEvent($name){

		DB::table('events')->where('id', $name)->delete();

		$events = DB::table('events')->where('email',Auth::user()->email)->get();
	    $event_list = [];
	
	    foreach ($events as $event) {
		
			if (strlen($event->name) > 30)
			$event->name = substr($event->name, 0, 20)."\n".substr($event->name, 21, strlen($event->name) - 20);
	
	    	$desc = $event->name."\nfrom ".$event->start_time." to ".$event->end_time;

			$event_list[] = array(
				$desc,
				$event->id,
				$event->name,
				true,
				$event->start_date,
				$event->end_date
			);
		}


		return view('events',compact('event_list')); 
	}

    /*
    protected function create(Request $request)
    {
	return new App\Event::create([
		'name' => $request['event_name'],
		'start_date' => $request['start_date'],
		'end_date' => $request['end_date'],
		'start_time' => $request['start_time'],
		'end_time' => $request['end_time'],
		'email' => Auth::user()->email,
	]);
    }*/
}
