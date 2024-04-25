<?php

namespace App\Http\Controllers;

use App\Models\StudentCourses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class studentCoursesController extends Controller
{
    public function getAllStudentCoursess(){

        $studentCourses = StudentCourses::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$studentCourses,
        ];
        return response()->json($data,200);
    }

    public function getStudentCoursesById($id)
    {
        $studentCourse = StudentCourses::find($id);
        if (!$studentCourse) {
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
            "data"=>$studentCourse
        ];
        return response()->json($data,200);
    }

    public function createStudentCourses(Request $request){
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

        $studentCourse = StudentCourses::create([
            'name' =>$request->name,
            'lastname' =>$request->lastname,
            'age' =>$request->age,
            'ci' =>$request->ci,
            'email' =>$request->email,
        ]);

        if(!$studentCourse){
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
            "data"=>$studentCourse,
        ];



        return response()->json($data,200);
    }

    public function updateStudentCourses(Request $request, $id)
    {
        $studentCourse = StudentCourses::find($id);
        if (!$studentCourse) {
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

        $studentCourse->name = $request->name;
        $studentCourse->lastname = $request->lastname;
        $studentCourse->age = $request->age;
        $studentCourse->ci = $request->ci;
        $studentCourse->email = $request->email;

        $studentCourse->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$studentCourse,
        ];
        return response()->json($data,200);
    }

    public function deleteStudentCourses($id)
    {
        $studentCourse = StudentCourses::find($id);
        if (!$studentCourse) {
            $data = [
                "message"=>"Estudiante no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $studentCourse->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}