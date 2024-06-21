<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $response = ['success' => "false"];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $response = ["error" => $validator->errors()];
            return response()->json($response,200);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']); // se realiza la encriptacion del password

        $user = User::create($data);
        $user->assignRole('client');

        $response['success'] = true;
        //$response['token'] = $user->createToken("codea")->plainTextToken;

        return response()->json($response, 201);

    }

    public function login(Request $request)
    {
        $response = ['success' => false];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $response = ["error" => $validator->errors()];
            return response()->json($response,200);
        }

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {

            $user = auth()->user();
            $user->hasRole('client'); //add rol
            $response['token'] = $user->createToken("code.app")->plainTextToken;
            $response['user'] = $user;
            $response['success'] = true;

        }

        return response()->json($response, 200);

    }

    public function logout()
    {

        $response = ["success" => false];
        auth()->user()->tokens()->delete();
        $response = [
            "success" => true,
            "message" => "Session Cerrada"
        ];
        return response()->json($response, 200);

    }



}
