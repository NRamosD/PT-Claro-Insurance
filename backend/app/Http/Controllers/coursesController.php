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
                "message"=>"Estudiante no encontrado",
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

        $course = Courses::create([
            'name' =>$request->name,
            'lastname' =>$request->lastname,
            'age' =>$request->age,
            'ci' =>$request->ci,
            'email' =>$request->email,
        ]);

        if(!$course){
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
            "data"=>$course,
        ];



        return response()->json($data,200);
    }

    public function updateCourses(Request $request, $id)
    {
        $course = Courses::find($id);
        if (!$course) {
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

        $course->name = $request->name;
        $course->lastname = $request->lastname;
        $course->age = $request->age;
        $course->ci = $request->ci;
        $course->email = $request->email;

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
                "message"=>"Estudiante no encontrado",
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