<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    public function index()
    {
        $data = Empresa::get(["id","nombre"]); // de esta forma unicamente se llaman los campos necesitados para visualizar
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = new Empresa($request->all());
        if($request->urlfoto)
        {
            $img = $request->urlfoto;
            $folderpath = "/img/empresa/";//se guarda la imagen
            $image_parts = explode(";base64,", $img); // se obtiene la imagen en formato base 64
            $image_type_aux = emplode("image/", $image_parts[0]); //
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);//aqui se encoda la imagen
            $file = $folderPath . Str::slug($request->nombre) . '.' . $image_type; // la ruta como se va a guardar la imagen
            file_put_contents(public_path($file), $image_base64);

            $data->urlfoto = Str::slug($request->nombre) . '.' . $image_type; // esta linea es la que envia la informacion a la base de datos
        }
        $data->save();
        return response()->json($data, 201);
    }

    public function show($id)
    {

        $data = Empresa::find($id);
        return response()->json($data, 201);

    }

    public function update(Request $request, $id)
    {

        $data = Empresa::find($id);
        $data->fill($request->all());
        if($request->urlfoto)
        {
            $img = $request->urlfoto;
            $folderpath = "/img/empresa/";//se guarda la imagen
            $image_parts = explode(";base64,", $img); // se obtiene la imagen en formato base 64
            $image_type_aux = emplode("image/", $image_parts[0]); //
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);//aqui se encoda la imagen
            $file = $folderPath . Str::slug($request->nombre) . '.' . $image_type; // la ruta como se va a guardar la imagen
            file_put_contents(public_path($file), $image_base64);

            $data->urlfoto = Str::slug($request->nombre) . '.' . $image_type; // esta linea es la que envia la informacion a la base de datos
        }
        $data->save();
        return response()->json($data, 201);

    }

    public function destroy($id)
    {
        $data = Empresa::find($id);
        $data->delete();
        return response()->json('Empresa Borrada', 201);
    }

}
