<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\TipoConvocatoria;
use App\Convocatoria;
use Validator;

class ConvocatoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Convocatoria::with('tipo_convocatoria', 'images', 'files')
            ->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('desde', 'desc')
            ->orderBy('hasta', 'desc')
            ->paginate(10);
        $tipos_convocatoria = TipoConvocatoria::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre', 'asc')
            ->get();
        $response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'items' => $items,
            'tipos_convocatoria' => $tipos_convocatoria,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $update = Convocatoria::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Convocatoria se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Convocatoria se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $tipo_convocatoria_id = $request->tipo_convocatoria_id;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $agenda = $request->agenda;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        if($hasta == null) {
          $hasta = '';
        }
        if($agenda == null) {
          $agenda = '';
        }
        // validation
        $messages = [
            'tipo_convocatoria_id.required' => 'Falta seleccionar el Tipo de Convocatoria',
            'desde.required' => 'Falta ingresar la Fecha Desde',
            'desde.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'hasta.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de Convocatoria ya existe',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
        	'tipo_convocatoria_id' => 'required',
            'desde' => 'required|date_format:"Y-m-d"',
            'hasta' => 'nullable|date_format:"Y-m-d"',
            'titulo' => 'required|unique:convocatorias,titulo',
            'main' => 'required',
        ], $messages);
        // create convocatoria
        $convocatoria = new Convocatoria;
        $convocatoria->user_id = auth('api')->user()->id;
        $convocatoria->tipo_convocatoria_id = $tipo_convocatoria_id;
        $convocatoria->titulo = $titulo;
        $convocatoria->slug = Str::slug($titulo);
        $convocatoria->descripcion = $descripcion;
        $convocatoria->desde = $desde;
        if($hasta != '') {
            $convocatoria->hasta = $hasta;
        }else {
            $convocatoria->hasta = null;
        }
        $convocatoria->agenda = $agenda;
        $convocatoria->main = $main;
        $convocatoria->active = 1;
        $convocatoria->save();
        $result = 1;
        $message = 'La Convocatoria se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // convocatoria
        $convocatoria = Convocatoria::findOrFail($id);
        // data from request
        $tipo_convocatoria_id = $request->tipo_convocatoria_id;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $agenda = $request->agenda;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        if($hasta == null) {
          $hasta = '';
        }
        if($agenda == null) {
          $agenda = '';
        }
        // validation
        $messages = [
            'tipo_convocatoria_id.required' => 'Falta seleccionar el Tipo de Convocatoria',
            'desde.required' => 'Falta ingresar la Fecha Desde',
            'desde.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'hasta.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de Convocatoria ya existe',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
        	'tipo_convocatoria_id' => 'required',
            'desde' => 'required|date_format:"Y-m-d"',
            'hasta' => 'nullable|date_format:"Y-m-d"',
            'titulo' => 'required|unique:convocatorias,titulo,' . $id,
            'main' => 'required',
        ], $messages);
        // update convocatoria
        $convocatoria->user_id = auth('api')->user()->id;
        $convocatoria->tipo_convocatoria_id = $tipo_convocatoria_id;
        $convocatoria->titulo = $titulo;
        $convocatoria->slug = Str::slug($titulo);
        $convocatoria->descripcion = $descripcion;
        $convocatoria->desde = $desde;
        if($hasta != '') {
            $convocatoria->hasta = $hasta;
        }else {
            $convocatoria->hasta = null;
        }
        $convocatoria->agenda = $agenda;
        $convocatoria->main = $main;
        $convocatoria->save();
        $result = 1;
        $message = 'La Convocatoria se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Convocatoria::findOrFail($id);
        // verify any relationship
        $delete->delete();
        $message = 'La Convocatoria se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function add_galeria(Request $request)
    {
        // request data
        $id = $request->id;
        $images = $request->file('images');
        // request data
        $result = 1;
        $message = '';
        // convocatoria
        $convocatoria = Convocatoria::where('id', $id)
            ->first();
        // images
        $contador = 1;
        if(isset($images)) {
            if(count($images) > 0) {
                foreach($images as $image) {
                    $input  = array('imagen' => $image);
                    $reglas = array('imagen' => 'required|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG');
                    $validator = Validator::make($input, $reglas);
                    if($validator->fails()) {
                        $message = "Uno o más archivos seleccionados como imagen no tienen una extensión válida, seleccione otros archivos";
                        $result = 0;
                        break;
                    }else {
                        // create image
                        $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $contador;
                        $extension = $image->getClientOriginalExtension();
                        $imagePath = $imageName . "." . $extension;
                        $upload = $image->move('archivos/imagenes/convocatorias/', $imagePath);
                        if($upload) {
                            $convocatoria->images()->create([
                                'name' => $imageName,
                                'path' => $imagePath,
                                'main' => 0,
                            ]);
                            $result = 1;
                            $message = "La(s) imagen(s) se añadieron correctamente";
                        }else {
                            $result = 0;
                            $message = "Error al subir la imagen, intente de nuevo más tarde";
                        }
                    }
                    $contador++;
                }
            }else {
                $result = 0;
                $message = 'Usted no ha seleccionado ninguna imagen';
            }
        }else {
            $result = 0;
            $message = 'Usted no ha seleccionado ninguna imagen';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    public function delete_galeria(Request $request)
    {
        $image_id = $request->image_id;
        $convocatoria_id = $request->convocatoria_id;
        $result = 1;
        $message = '';
        $delete = Convocatoria::findOrFail($convocatoria_id);
        $delete->images()->where('id', $image_id)->delete();
        $message = 'La Imagen se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function add_documento(Request $request)
    {
        // request data
        $id = $request->id;
        $descripcion = $request->descripcion;
        $documento = $request->file('documento');
        // response data
        $result = 1;
        $message = '';
        // convocatoria
        $convocatoria = Convocatoria::findOrFail($id);
        $input  = array('descripcion' => $descripcion);
        $reglas = array('descripcion' => 'required');
        $validator = Validator::make($input, $reglas);
        if($validator->fails()) {
            $result = 0;
            $message = 'Falta ingresar el nombre o descripción del documento';
        }else {
            if($documento != null) {
                $input  = array('documento' => $documento);
                $reglas = array('documento' => 'required||mimes:pdf');
                $validator = Validator::make($input, $reglas);
                if($validator->fails()) {
                    $result = 0;
                    $message = "El Documento no tiene una extensión válida, seleccione otro archivo";
                }else {
                    $fileName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $id;
                    $extension = $documento->getClientOriginalExtension();
                    $filePath = $fileName . "." . $extension;
                    $upload = $documento->move('archivos/documentos/convocatorias/', $filePath);
                    if($upload) {
                        $convocatoria->files()->create([
                            'name' => $descripcion,
                            'path' => $filePath,
                        ]);
                        $result = 1;
                        $message = "El documento se añadió correctamente";
                    }else {
                        $result = 0;
                        $message = "Error al subir el archivo, intente de nuevo más tarde";
                    }
                }
            }else {
                $result = 0;
                $message = 'Usted no ha seleccionado ningún documento';
            }
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    public function delete_documento(Request $request)
    {
        $file_id = $request->file_id;
        $convocatoria_id = $request->convocatoria_id;
        $result = 1;
        $message = '';
        $delete = Convocatoria::findOrFail($convocatoria_id);
        $delete->files()->where('id', $file_id)->delete();
        $message = 'El documento se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
