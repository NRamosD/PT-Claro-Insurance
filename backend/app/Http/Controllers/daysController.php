<?php

namespace App\Http\Controllers;

use App\Models\Days;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class daysController extends Controller
{
    public function getAllDays(){

        $days = Days::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$days,
        ];
        return response()->json($data,200);
    }

    public function getDaysById($id)
    {
        $day = Days::find($id);
        if (!$day) {
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
            "data"=>$day
        ];
        return response()->json($data,200);
    }

    public function createDays(Request $request){
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

        $day = Days::create([
            'name' =>$request->name,
            'lastname' =>$request->lastname,
            'age' =>$request->age,
            'ci' =>$request->ci,
            'email' =>$request->email,
        ]);

        if(!$day){
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
            "data"=>$day,
        ];



        return response()->json($data,200);
    }

    public function updateDays(Request $request, $id)
    {
        $day = Days::find($id);
        if (!$day) {
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

        $day->name = $request->name;
        $day->lastname = $request->lastname;
        $day->age = $request->age;
        $day->ci = $request->ci;
        $day->email = $request->email;

        $day->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$day,
        ];
        return response()->json($data,200);
    }

    public function deleteDays($id)
    {
        $day = Days::find($id);
        if (!$day) {
            $data = [
                "message"=>"Estudiante no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $day->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}