<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class scheduleController extends Controller
{
    public function getAllSchedules(){

        $schedules = Schedule::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$schedules,
        ];
        return response()->json($data,200);
    }

    public function getScheduleById($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            $data = [
                "message"=>"horario no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$schedule
        ];
        return response()->json($data,200);
    }

    public function createSchedule(Request $request){
        $validator = Validator::make($request->all(),[

            "name"=> "",
            "start_time"=> 'required',
            "end_time"=> 'required',
            "id_course"=> 'required',
            "id_day"=> 'required',
        ]);

        if($validator->fails()){
            $data = [
                "message"=>"Error al validar los datos",
                "status"=>400,
                "data"=>[],
                "errors"=>$validator->errors(),
            ];
            return response()->json($data,400);    
        };

        $schedule = Schedule::create([

            "name" =>$request->name,
            "start_time" =>$request->start_time,
            "end_time" =>$request->end_time,
            "id_course" =>$request->id_course,
            "id_day" =>$request->id_day

        ]);

        if(!$schedule){
            $data = [
                "message"=>"Error al crear horario",
                "status"=>500,
                "data"=>[]
            ];
            return response()->json($data,500);    
        }

        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$schedule,
        ];



        return response()->json($data,200);
    }

    public function updateSchedule(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            $data = [
                "message"=>"horario no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        
        $validator = Validator::make($request->all(),[

            "name"=> "",
            "start_time"=> 'required',
            "end_time"=> 'required',
            "id_course"=> 'required',
            "id_day"=> 'required',
        ]);

        if($validator->fails()){
            $data = [
                "message"=>"Error al validar los datos",
                "status"=>400,
                "data"=>[],
                "errors"=>$validator->errors(),
            ];
            return response()->json($data,400);    
        };

        $schedule->name = $request->name;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->id_course = $request->id_course;
        $schedule->id_day = $request->id_day;

        $schedule->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$schedule,
        ];
        return response()->json($data,200);
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            $data = [
                "message"=>"horario no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $schedule->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}
