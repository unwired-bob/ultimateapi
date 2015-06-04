<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\Http\Requests\CreateAppointmentRequest;
//I had to add this because Larvel was not properly handling
// parameter validation. So I have a rules that is empty.
// I can add the error handling in the update api
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        //return 'I\'m in index';

        // Go to the Appointment model and get all the data!
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateAppointmentRequest $request)
    {
        //Storing a new value via post. 
        $values = $request->only('start_time','end_time','first_name','last_name','comment');

        // comment is not necessarily required.  If a comment is not there in the request
        // we need to check that it is not NULL

        if($values['comment']===NULL)
        {
            $values['comment']='';
        }

        // print the values so Postman can see it... return $values;
        $model = Appointment::create($values);

        //return $model['id'];
        //$id = $model['id'];

        //response()->json(['message' => 'Appointment added!','id'=>$id ],201);
        // Look into putting a resource ID in the Location http header. 
        return response()->json(['message' => 'Appointment added!','id'=>$model['id']],201);
        //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        //return 'I\'m in index'.$id;
        $appointment = Appointment::find($id);

        if(!$appointment)
        {
            return response()->json(['message' => 'This appointent does not exist','code'=>404],404); 
        }

        return response()->json(['appointment' => $appointment],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CreateAppointmentRequest $request,  $id)
    {

        // Updates with postman is not quite working as expected lol
        //http://laravel.io/forum/02-13-2014-i-can-not-get-inputs-from-a-putpatch-request

        $appointment=Appointment::find($id);

        if(!$appointment)
        {
            return response()->json(['message' => 'This appointent does not exist','code'=>404],404); 
        }



        //Storing a new value via post. 
        $values = $request->only('start_time','end_time','first_name','last_name','comment');

        // comment is not necessarily required.  If a comment is not there in the request
        // we need to check that it is not NULL




        if($values['comment']===NULL)
        {
            $values['comment']='';
        }

        $appointment->start_time = $values['start_time'];
        $appointment->end_time = $values['end_time'];
        $appointment->first_name = $values['first_name'];
        $appointment->last_name = $values['last_name'];
        $appointment->comment = $values['comment'];
        
        

        $appointment->save();

        //return $model['id'];
        //$id = $model['id'];

        //response()->json(['message' => 'Appointment added!','id'=>$id ],201);
        // Look into putting a resource ID in the Location http header. 
        return response()->json(['message' => 'Appointment Updated!','id'=>$appointment->id],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $appointment=Appointment::find($id);

        if(!$appointment)
        {
            return response()->json(['message' => 'This appointent does not exist','code'=>404],404); 
        }

        $appointment->delete();

        return response()->json(['message' => 'This appointent has been deleted','code'=>200],200); 

    }
}
