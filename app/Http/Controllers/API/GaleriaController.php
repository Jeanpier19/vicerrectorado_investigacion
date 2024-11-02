<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Galeria;
use Validator;

class GaleriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Galeria::with('images')
            ->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%')
                	->orWhere('descripcion', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(10);
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
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $update = Galeria::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Galeria se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Galeria se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
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
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de Galeria ya existe',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'titulo' => 'required|unique:galerias,titulo',
            'main' => 'required',
        ], $messages);
        // create galeria
        $galeria = new Galeria;
        $galeria->user_id = auth('api')->user()->id;
        $galeria->titulo = $titulo;
        $galeria->slug = Str::slug($titulo);
        $galeria->descripcion = $descripcion;
        $galeria->main = $main;
        $galeria->active = 1;
        $galeria->save();
        $result = 1;
        $message = 'La Galeria se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // galeria
        $galeria = Galeria::findOrFail($id);
        // data from request
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
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
            'titulo.required' => 'Falta ingresar el título',
            'titulo.unique' => 'El título de la Galeria ya existe',
            'main.required' => 'Falta seleccionar la prioridad'
        ];
        $this->validate($request, [
            'titulo' => 'required|unique:galerias,titulo,' . $id,
            'main' => 'required',
        ], $messages);
        // create galeria
        $galeria->user_id = auth('api')->user()->id;
        $galeria->titulo = $titulo;
        $galeria->slug = Str::slug($titulo);
        $galeria->descripcion = $descripcion;
        $galeria->main = $main;
        $galeria->save();
        $result = 1;
        $message = 'La Galeria se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Galeria::findOrFail($id);
        // verify any relationship
        $delete->delete();
        $message = 'La Galeria se eliminó correctamente';
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
        // galeria
        $galeria = Galeria::where('id', $id)
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
                        $upload = $image->move('archivos/imagenes/galerias/', $imagePath);
                        if($upload) {
                            $galeria->images()->create([
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
        $galeria_id = $request->galeria_id;
        $result = 1;
        $message = '';
        $delete = Galeria::findOrFail($galeria_id);
        $delete->images()->where('id', $image_id)->delete();
        $message = 'La Imagen se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
