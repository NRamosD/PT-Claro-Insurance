<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class coursesController extends Controller
{
    public function getAllCourses(){

        $courses = Courses::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$courses,
        ];
        return response()->json($data,200);
    }

    public function getCoursesById($id)
    {
        $course = Courses::find($id);
        if (!$course) {
            $data = [
                "message"=>"curso no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$course
        ];
        return response()->json($data,200);
    }

    public function createCourses(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => 'required',
            "id_schedule" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "type" => 'required',
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

        $course = Courses::create([
            "name" =>$request->name,
            "id_schedule" =>$request->id_schedule,
            "start_date" =>$request->start_date,
            "end_date" =>$request->end_date,
            "type" =>$request->type,
        ]);

        if(!$course){
            $data = [
                "message"=>"Error al crear curso",
                "status"=>500,
                "data"=>[]
            ];
            return response()->json($data,500);    
        }

        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$course,
        ];



        return response()->json($data,200);
    }

    public function updateCourses(Request $request, $id)
    {
        $course = Courses::find($id);
        if (!$course) {
            $data = [
                "message"=>"curso no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            "name" => 'required',
            "id_schedule" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "type" => 'required',
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

        $course->name = $request->name;
        $course->id_schedule = $request->id_schedule;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->type = $request->type;

        $course->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$course,
        ];
        return response()->json($data,200);
    }

    public function deleteCourses($id)
    {
        $course = Courses::find($id);
        if (!$course) {
            $data = [
                "message"=>"curso no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $course->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}