<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class administratorController extends Controller
{
    public function getAllAdministrators(){

        $administrators = Administrator::all();
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$administrators,
        ];
        return response()->json($data,200);
    }

    public function getAdministratorById($id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            $data = [
                "message"=>"administrador no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$administrator
        ];
        return response()->json($data,200);
    }

    public function createAdministrator(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "lastname"=>"required",
            "password"=>"required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/",
            "email"=>"required"
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

        $encryptedPassword = Hash::make($request->password);

        $administrator = Administrator::create([
            "name"=>$request->name,
            "lastname"=>$request->lastname,
            "password"=>$encryptedPassword,
            "email"=>$request->email,
        ]);

        if(!$administrator){
            $data = [
                "message"=>"Error al crear administrador",
                "status"=>500,
                "data"=>[]
            ];
            return response()->json($data,500);    
        }

        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$administrator,
        ];



        return response()->json($data,200);
    }

    public function updateAdministrator(Request $request, $id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            $data = [
                "message"=>"administrador no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "lastname"=>"required",
            "email"=>"required"
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

        $administrator->name = $request->name;
        $administrator->lastname = $request->lastname;
        $administrator->email = $request->email;

        $administrator->save();


        $data = [
            "message"=>"OK",
            "status"=>200,
            "data"=>$administrator,
        ];
        return response()->json($data,200);
    }

    public function deleteAdministrator($id)
    {
        $administrator = Administrator::find($id);
        if (!$administrator) {
            $data = [
                "message"=>"administrador no encontrado",
                "status"=>404,
                "data"=>[]
            ];
            return response()->json($data, 404);
        }
        $administrator->delete();
        $data = [
            "message"=>"OK",
            "status"=>200,
        ];
        return response()->json($data,200);
    }



}