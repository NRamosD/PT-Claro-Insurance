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
                "message"=>"dia no encontrado",
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
            'day_name' => 'required'
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
            'day_name' =>$request->day_name
        ]);

        if(!$day){
            $data = [
                "message"=>"Error al crear dia",
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
                "message"=>"dia no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        
        $validator = Validator::make($request->all(),[
            'day_name' => 'required'
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

        $day->day_name = $request->day_name;

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
                "message"=>"dia no encontrado",
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