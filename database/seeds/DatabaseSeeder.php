<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       // There are no foreign relationships but set it here anyways
       //DB::statement('SET_FOREIGN_KEY_CHECKS = 0');
        Appointment::truncate();
        Model::unguard();

        // $this->call('UserTableSeeder');

        $this->call('AppointmentsSeed');

        Model::reguard();
    }
}
