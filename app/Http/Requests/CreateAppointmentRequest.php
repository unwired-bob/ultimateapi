<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAppointmentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Set to true we will not do authentication here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return 
        [
            'start_time' => 'required',
            'end_time'=> 'required',
            'first_name'=> 'required',
            'last_name' => 'required',
            //'comment' => 'required'  We don;t need a comment
        ];
    }



    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {

        return response()->json(['message'=>'The following paremeters are required: start_time, end_time, first_name, last_name','code'=>422],422);

    }
}
