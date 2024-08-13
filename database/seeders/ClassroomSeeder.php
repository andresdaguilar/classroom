<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        DB::table('classrooms')->insert([
            [
                'name' => 'Math Classroom',
                'days' => 'Monday,Tuesday,Wednesday',
                'start_time' => '09:00:00',
                'end_time' => '19:00:00',
                'capacity' => 10,
                'interval' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Art Classroom',
                'days' => 'Monday,Thursday,Saturday',
                'start_time' => '08:00:00',
                'end_time' => '18:00:00',
                'capacity' => 15,
                'interval' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Science Classtroom',
              'days' => 'Tueday,Friday,Saturday',
              'start_time' => '15:00:00',
              'end_time' => '22:00:00',
              'capacity' => 22,
              'interval' => 1,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Geography Classtroom',
              'days' => 'Thursday,Friday',
              'start_time' => '08:00:00',
              'end_time' => '18:00:00',
              'capacity' => 15,
              'interval' => 2,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Computer Science Classtroom',
              'days' => 'Monday,Friday',
              'start_time' => '13:00:00',
              'end_time' => '15:00:00',
              'capacity' => 23,
              'interval' => 1,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'History Classroom',
              'days' => 'Monday,Friday',
              'start_time' => '10:00:00',
              'end_time' => '19:00:00',
              'capacity' => 11,
              'interval' => 3,
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],            
        ]);
    }
}
