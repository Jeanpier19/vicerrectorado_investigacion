<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Etiqueta;
use App\Comunicado;
use Validator;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Comunicado::where('tipo', 2)
            ->with('etiquetas', 'images', 'files')
            ->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->orderBy('fecha', 'desc')
            ->paginate(10);
        $etiquetas = Etiqueta::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre', 'asc')
            ->get(['id', 'nombre']);
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
            'etiquetas' => $etiquetas,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $update = Comunicado::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Evento se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Evento se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $etiquetas = $request->etiquetas;
        $fecha = $request->fecha;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $lugar = $request->lugar;
        $dirigido = $request->dirigido;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        // validation
        $messages = [
            'fecha.required' => 'Falta ingresar la Fecha',
            'fecha.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de Evento ya existe',
            'lugar.required' => 'Falta ingresar el Lugar',
            'dirigido.required' => 'Falta ingresar el Público Dirigido',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'fecha' => 'required|date_format:"Y-m-d"',
            'titulo' => 'required|unique:comunicados,titulo',
            'lugar' => 'required',
            'dirigido' => 'required',
            'main' => 'required',
        ], $messages);
        // create evento
        $evento = new Comunicado;
        $evento->user_id = auth('api')->user()->id;
        $evento->tipo = 2;
        $evento->titulo = $titulo;
        $evento->slug = Str::slug($titulo);
        $evento->descripcion = $descripcion;
        $evento->fecha = $fecha;
        $evento->lugar = $lugar;
        $evento->dirigido = $dirigido;
        $evento->main = $main;
        $evento->active = 1;
        $evento->save();
        $evento->etiquetas()->sync($etiquetas);
        $result = 1;
        $message = 'El Evento se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // evento
        $evento = Comunicado::findOrFail($id);
        // data from request
        $etiquetas = $request->etiquetas;
        $fecha = $request->fecha;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $lugar = $request->lugar;
        $dirigido = $request->dirigido;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        // validation
        $messages = [
            'fecha.required' => 'Falta ingresar la fecha',
            'fecha.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'titulo.required' => 'Falta ingresar el título',
            'titulo.unique' => 'El título de la Evento ya existe',
            'lugar.required' => 'Falta ingresar el Lugar',
            'dirigido.required' => 'Falta ingresar el Público Dirigido',
            'main.required' => 'Falta seleccionar la prioridad'
        ];
        $this->validate($request, [
            'fecha' => 'required|date_format:"Y-m-d"',
            'titulo' => 'required|unique:comunicados,titulo,' . $id,
            'lugar' => 'required',
            'dirigido' => 'required',
            'main' => 'required',
        ], $messages);
        // create evento
        $evento->user_id = auth('api')->user()->id;
        $evento->titulo = $titulo;
        $evento->slug = Str::slug($titulo);
        $evento->descripcion = $descripcion;
        $evento->fecha = $fecha;
        $evento->lugar = $lugar;
        $evento->dirigido = $dirigido;
        $evento->main = $main;
        $evento->save();
        $evento->etiquetas()->sync($etiquetas);
        $result = 1;
        $message = 'El Evento se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Comunicado::findOrFail($id);
        // verify any relationship
        $delete->delete();
        $message = 'El Evento se eliminó correctamente';
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
        // evento
        $evento = Comunicado::where('id', $id)
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
                        $upload = $image->move('archivos/imagenes/eventos/', $imagePath);
                        if($upload) {
                            $evento->images()->create([
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
        $evento_id = $request->evento_id;
        $result = 1;
        $message = '';
        $delete = Comunicado::findOrFail($evento_id);
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
        // evento
        $evento = Comunicado::findOrFail($id);
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
                    $upload = $documento->move('archivos/documentos/eventos/', $filePath);
                    if($upload) {
                        $evento->files()->create([
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
        $evento_id = $request->evento_id;
        $result = 1;
        $message = '';
        $delete = Comunicado::findOrFail($evento_id);
        $delete->files()->where('id', $file_id)->delete();
        $message = 'El documento se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
