<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    //shows the events on the page
    public function index(){
        return view('events');
    }
    //adds event and makes sure all data entries are filled out
    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if($validator->fails()){
            \Session::flash('warning', 'Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);

        }

        $event = new Event;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();

        \Session::flash('succes', 'Event has been added to your calendar.');
        return Redirect::to('/events');
    }
}
