<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        //$data = User::all();
        $data = User::get(["id","name"]); // de esta forma unicamente se llaman los campos necesitados para visualizar
        return response()->json($data, 201);
    }

    public function show($id)
    {

        $data = User::find($id);
        return response()->json($data, 201);

    }

    public function update(Request $request, $id)
    {

        $data = User::find($id);
        $data->fill($request->all());
        $data->save();

        return response()->json($data, 201);

    }

}
