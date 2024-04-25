<?php

namespace App\Http\Controllers;

use App\Models\StudentCourses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class studentCoursesController extends Controller
{
    public function getAllStudentCourses(){

        $studentCourses = StudentCourses::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$studentCourses,
        ];
        return response()->json($data,200);
    }

    public function getStudentCourseById($id)
    {
        $studentCourse = StudentCourses::find($id);
        if (!$studentCourse) {
            $data = [
                "message"=>"registro de EstudianteCurso no encontrado",
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

    public function createStudentCourse(Request $request){

        $validator = Validator::make($request->all(),[
            "id_course" => "required",
            "id_student" => "required"
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
            "description" => $request->description,
            "id_course" => $request->id_course,
            "id_student" => $request->id_student
        ]);

        if(!$studentCourse){
            $data = [
                "message"=>"Error al crear registro de EstudianteCurso",
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
                "message"=>"registro de EstudianteCurso no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        
        $validator = Validator::make($request->all(),[
            "id_course" => "required",
            "id_student" => "required"
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

        $studentCourse->description = $request->description;
        $studentCourse->id_course = $request->id_course;
        $studentCourse->id_student = $request->id_student;

        $studentCourse->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$studentCourse,
        ];
        return response()->json($data,200);
    }

    public function deleteStudentCourse($id)
    {
        $studentCourse = StudentCourses::find($id);
        if (!$studentCourse) {
            $data = [
                "message"=>"registro de EstudianteCurso no encontrado",
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