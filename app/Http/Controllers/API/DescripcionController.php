<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Descripcion;
use Illuminate\Support\Str;

class DescripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $descripcion = Descripcion::latest('updated_at')
        	->with('file')
            ->first();
        $response = [
            'descripcion' => $descripcion
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        // 
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $descripcion = Descripcion::findOrFail($id);
        // data from request
        $descripcion_req = $request->descripcion;
        $mision = $request->mision;
        $vision = $request->vision;
        $direccion = $request->direccion;
        $email_1 = $request->email_1;
        $email_2 = $request->email_2;
        $email_3 = $request->email_3;
        $telefono_1 = $request->telefono_1;
        $telefono_2 = $request->telefono_2;
        $telefono_3 = $request->telefono_3;
        $anexo_1 = $request->anexo_1;
        $anexo_2 = $request->anexo_2;
        $anexo_3 = $request->anexo_3;
        $organigrama_path = $request->organigrama_path;
        $organigrama = $request->organigrama;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($email_2 == null) {
          $email_2 = '';
        }
        if($email_3 == null) {
          $email_3 = '';
        }
        if($telefono_2 == null) {
          $telefono_2 = '';
        }
        if($telefono_3 == null) {
          $telefono_3 = '';
        }
        if($anexo_2 == null) {
          $anexo_2 = '';
        }
        if($anexo_3 == null) {
          $anexo_3 = '';
        }
        // validation
        $messages = [
            'descripcion.required' => 'Falta ingresar la Descripción',
            'mision.required' => 'Falta ingresar la Misión',
            'vision.required' => 'Falta ingresar la Visión',
            'direccion.required' => 'Falta ingresar la Dirección',
            'email_1.required' => 'Falta ingresar el Email 1',
            'telefono_1.required' => 'Falta ingresar el Teléfono 1',
            'anexo_1.required' => 'Falta ingresar el Anexo 1',
            'organigrama.mimes' => 'El Archivo seleccionado no tiene una extensión válida',
        ];
        $this->validate($request, [
            'descripcion' => 'required',
            'mision' => 'required',
            'vision' => 'required',
            'direccion' => 'required',
            'email_1' => 'required',
            'telefono_1' => 'required',
            'anexo_1' => 'required',
            'organigrama' => 'nullable|mimes:pdf',
        ], $messages);
        // update descripcion
        $descripcion->descripcion = $descripcion_req;
        $descripcion->mision = $mision;
        $descripcion->vision = $vision;
        $descripcion->direccion = $direccion;
        $descripcion->email_1 = $email_1;
        $descripcion->email_2 = $email_2;
        $descripcion->email_3 = $email_3;
        $descripcion->telefono_1 = $telefono_1;
        $descripcion->telefono_2 = $telefono_2;
        $descripcion->telefono_3 = $telefono_3;
        $descripcion->anexo_1 = $anexo_1;
        $descripcion->anexo_2 = $anexo_2;
        $descripcion->anexo_3 = $anexo_3;
        $descripcion->save();
        $result = 1;
        // update file
        if($request->hasFile('organigrama')) {
            // old file
            $oldFile = $descripcion->file;
            // file name
            $fileName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $descripcion->id;
            $extension = $organigrama->getClientOriginalExtension();
            $filePath = $fileName . "." . $extension;
            // upload file
            $upload = $organigrama->move('archivos/documentos/descripcion', $filePath);
            if($upload) {
                if($oldFile != null) {
                    $oldFile->update([
                        'name' => 'Organigrama',
                        'path' => $filePath,
                    ]);
                }else {
                    $descripcion->file()->create([
                        'name' => 'Organigrama',
                        'path' => $filePath,
                    ]);
                }
                $result = 1;
                $message = 'Los datos se actualizaron correctamente';
            }else {
                $result = 0;
                $message = "Error al subir el archivo, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'Los datos se actualizaron correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // 
    }
}
