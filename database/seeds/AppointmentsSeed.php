<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Appointment;
use Faker\Factory as Faker;

class AppointmentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // I don't think we need any fake data$faker = Faker::create();

        ini_set('auto_detect_line_endings',true);
        
        $firstLine = true;
        $count = 0;


        $startTimeComponents;
        $endTimeComponents;

        $startMonthDayYearComponents;
        $endMonthDayYearComponents;
        $year = "2000";
        $month = "1";
        $day = "5";

        //YYYY-MM-DD
        $startMonthDayYear = "2000-01-05";
        $endMonthDayYear = "2000-01-05";

        $startHourMinutesSecond = "00:00:00";
        $endHourMinutesSecond = "00:00:00";

        $handle = fopen('E:\\xampp\\htdocs\\ultimateapi\\appt_data.csv','rt');

        while ( ($data = fgetcsv($handle) ) !== FALSE ) 
        {
            if($firstLine == true)
            {
                $firstLine = false;
                continue;

            }
            $count++;
            // This line prints the raw data as it is being read.
            //print_r($data);


            // Massage the data.  Comments can be blank. Make sure they are not null
            if($data[4] === NULL)
            {
                $data[4]='';
            }


            // Of course we need to massage the data here to get it into a format I think would work
            
            $startTimeComponents = preg_split('/\s+/',$data[0]);
            $endTimeComponents = preg_split('/\s+/',$data[1]);

            // Build up the start and end dates to be something cleaner for SQL
            // Take the input string and chop it up into compoents.
            $startMonthDayYearComponents = preg_split( '/\//' , $startTimeComponents[0]);
            $endMonthDayYearComponents = preg_split('/\//'  , $endTimeComponents[0]);
            //print_r( $startMonthDayYearComponents);
            //print_r( $endMonthDayYearComponents);
            $startMonthDayYear = "20".$startMonthDayYearComponents[2]."-".
            $startMonthDayYearComponents[0]."-".$startMonthDayYearComponents[1];

            $endMonthDayYear = "20".$endMonthDayYearComponents[2]."-".
            $endMonthDayYearComponents[0]."-".$endMonthDayYearComponents[1];
            
            //print_r($startMonthDayYear."\n");
            //print_r($endMonthDayYear."\n");


            // Build up the start and end time  to be something cleaner for MySQL DateTime
            $startHourMinutesSecond = $startTimeComponents[1].":00";
            $endHourMinutesSecond = $endTimeComponents[1].":00";
            //print_r($startHourMinutesSecond."\n");
            //print_r($endHourMinutesSecond."\n");

            printf("start_time=>%s \n",$startMonthDayYear." ".$startHourMinutesSecond);
            printf("end_time=>%s  \n",$endMonthDayYear." ".$endHourMinutesSecond);
            printf("first_name=>%s  \n",$data[2]);
            printf("last_name=>%s  \n",$data[3]);
            printf("comment=>%s  \n",$data[4]);


            /* At this point the data looks clean. Put it in the DB seed it! */
            Appointment::create
            ([
                'start_time' => $startMonthDayYear." ".$startHourMinutesSecond,
                'end_time' => $endMonthDayYear." ".$endHourMinutesSecond,
                'first_name' => $data[2],
                'last_name' => $data[3],
                'comment'=> $data[4]

            ]);


        }

        print_r($count);



/*        for($i = 0; $i < 6; $i++)
        {

            Appointment::create
            ([
                'start_time' => ,
                'end_time' => ,
                'first_name' => ,
                'last_name' => ,
                'comments'=>

            ]);
        }*/


        ini_set('auto_detect_line_endings',false);
    }
}
