@extends('layouts.app')


@section('content')

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <div class="container">

            <div class="panel panel-primary">

              <div class="panel-heading"> Calendar to keep track of Events</div>

                <div class="panel-body">

                   {!! Form::open(array('route' => 'events.add','method'=>'POST','files'=>'true')) !!}
                   <div class="row">
                       <div class = "col-xs-12 col-sm-12 col-md-12">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success')  }}</div>
                                @elseif (Session::has('warning'))
                                      <div class="alert alert-danger">{{ Session::get('warning')  }}</div>
                                @endif

                    </div>
                    
                      <div class="col-xs-4 col-sm-4 col-md-4">
                         <div class="form-group">
                               {!! Form::label('event_name','Event Name:') !!}
                                    <div class="">
                                    {!! Form::text('event_name',null,['class' => 'form-control']) !!}
                                    {!! $errors->first('event_name', '<p class="aler aler-danger">:message</p>') !!}
                                    </div>
                          </div>
                      </div>

                      <div class = "col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                           {!! Form::label('start_date', 'Start Date:') !!}
                           <div class="">
                           {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                           {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                           </div>
                        </div>
                      </div>

                      <div class = "col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                           {!! Form::label('end_date', 'End Date:') !!}
                           <div class="">
                           {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                           {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                           </div>
                        </div>
                      </div>


		      <div class = "col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                           {!! Form::label('start_time', 'Start Time:') !!}
                           <div class="">
                           {!! Form::time('start_time', null, ['class' => 'form-control']) !!}
                           {!! $errors->first('start_time', '<p class="alert alert-danger">:message</p>') !!}
                           </div>
                        </div>
                      </div>

		      <div class = "col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                           {!! Form::label('end_date', 'End Time:') !!}
                           <div class="">
                           {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                           {!! $errors->first('end_time', '<p class="alert alert-danger">:message</p>') !!}
                           </div>
                        </div>
                      </div>

                      <div class="col-xs-1 col-sm1 col-md-1 text-center"> &nbsp;<br/>
                      {!! Form::submit('Add Event',['class' => 'btn btn-primary']) !!}
                      </div>


                      
                    </div>          

                </div>

                <button onclick="location.href='{{ url('calendar') }}'">
                View your Calendar</button>

                {!! Form::close() !!}

            </div>






        </div>

        

@endsection

