<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Events;

class EventsController extends Controller
{
    //shows the events on the page
    public function index(){
     //   $events = Event::get();
    //    $event_list = [];

  //     foreach($events as $key => $event){
   //         $event_list = Calendar::event(
  //              $event->event_name,
  //              true,
   //             new \DateTime($event->start_date),
    //            new \DateTime($event->end_date. ' +1 day')
    //        );
    //     }
    //     $calendar_details = Calendar::addEvents($event_list);
        return view('events');  
        //, compact('calendar_details')
    }
    //adds event and makes sure all data entries are filled out
    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'event_name' => 'required',
            'start_date' => 'required',
	    'end_date' => 'required',
	    'start_time' => 'required',
	    'end_time' => 'required'
        ]);

        if($validator->fails()){
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
				  	  'end_date' => $request['end_date'],
					  'start_time' => $request['start_time'],
					  'end_time' => $request['end_time'],
					  'email' => Auth::user()->email,
				        ]);

        \Session::flash('success', 'Event has been added to your calendar.');
        return Redirect::to('/events');
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
