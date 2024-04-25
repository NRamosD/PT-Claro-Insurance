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
                "message"=>"Estudiante no encontrado",
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
            'name' => 'required',
            'lastname' => 'required',
            'age' => 'required|integer|min:18',
            'ci' => 'required',
            'email' => 'required|email|unique:student,email',
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
            'name' =>$request->name,
            'lastname' =>$request->lastname,
            'age' =>$request->age,
            'ci' =>$request->ci,
            'email' =>$request->email,
        ]);

        if(!$schedule){
            $data = [
                "message"=>"Error al crear estudiante",
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
                "message"=>"Estudiante no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'lastname' => 'required',
            'age' => 'required|integer',
            'ci' => 'required',
            'email' => 'required|email',
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
        $schedule->lastname = $request->lastname;
        $schedule->age = $request->age;
        $schedule->ci = $request->ci;
        $schedule->email = $request->email;

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
                "message"=>"Estudiante no encontrado",
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
