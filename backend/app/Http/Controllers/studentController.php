<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function getAllStudents(){

        $students = Student::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$students,
        ];
        return response()->json($data,200);
    }

    public function getStudentById($id)
    {
        $student = Student::find($id);
        if (!$student) {
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
            "data"=>$student
        ];
        return response()->json($data,200);
    }

    public function createStudent(Request $request){
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

        $student = Student::create([
            'name' =>$request->name,
            'lastname' =>$request->lastname,
            'age' =>$request->age,
            'ci' =>$request->ci,
            'email' =>$request->email,
        ]);

        if(!$student){
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
            "data"=>$student,
        ];



        return response()->json($data,200);
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
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

        $student->name = $request->name;
        $student->lastname = $request->lastname;
        $student->age = $request->age;
        $student->ci = $request->ci;
        $student->email = $request->email;

        $student->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$student,
        ];
        return response()->json($data,200);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if (!$student) {
            $data = [
                "message"=>"Estudiante no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $student->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}
