<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Appointment extends Model
{

	protected $table = 'appointments';

	protected $fillable = ['start_time', 'end_time','first_name', 'last_name','comment'];
	//protected $hidden = ['id','created_at','updated_at'];
	// For whatever reason I want to see the ID along with the data. 
	protected $hidden = ['created_at','updated_at'];


}

