<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\TipoPublicacion;
use App\Publicacion;

class PublicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Publicacion::with('tipo_publicacion', 'image', 'file')
            ->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(10);
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
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
            'tipos_publicacion' => $tipos_publicacion,
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Publicacion::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'La Publicación se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'La Publicación se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $tipo_publicacion_id = $request->tipo_publicacion_id;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $main = $request->main;
        $file = $request->file;
        $image = $request->image;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        // validation
        $messages = [
            'tipo_publicacion_id.required' => 'Falta seleccionar el Tipo de Publicación',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de la Publicación ya existe',
            'main.required' => 'Falta seleccionar la Prioridad',
            'file.required' => 'Falta seleccionar el Archivo',
            'file.mimes' => 'El Archivo seleccionado no tiene una extensión válida',
            'image.required' => 'Falta seleccionar la Imagen',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'tipo_publicacion_id' => 'required',
            'titulo' => 'required|unique:comunicados,titulo',
            'main' => 'required',
            'file' => 'required|mimes:pdf,PDF',
            'image' => 'required|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // create publicacion
        $publicacion = new Publicacion;
        $publicacion->user_id = auth('api')->user()->id;
        $publicacion->tipo_publicacion_id = $tipo_publicacion_id;
        $publicacion->titulo = $titulo;
        $publicacion->slug = Str::slug($titulo);
        $publicacion->descripcion = $descripcion;
        $publicacion->main = $main;
        $publicacion->active = 1; 
        $publicacion->save();
        // create image
        if($request->hasFile('image')) {
            // image name
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $publicacion->slug;
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            // upload image
            $upload = $image->move('archivos/imagenes/publicaciones', $imagePath);
            if($upload) {
                $publicacion->image()->create([
                    'name' => $publicacion->slug,
                    'path' => $imagePath,
                    'main' => 1,
                ]);
                $result = 1;
                $message = 'La Publicación se registró correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'La Publicación se registró correctamente';
        }
        // create file
        if($request->hasFile('file')) {
            // file name
            $fileName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $publicacion->slug;
            $extension = $file->getClientOriginalExtension();
            $filePath = $fileName . "." . $extension;
            // upload file
            $upload = $file->move('archivos/documentos/publicaciones', $filePath);
            if($upload) {
                $publicacion->file()->create([
                    'name' => $publicacion->slug,
                    'path' => $filePath,
                ]);
                $result = 1;
                $message = 'La Publicación se registró correctamente';
            }else {
                $result = 0;
                $message = "Error al subir el Archivo, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'La Publicación se registró correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $publicacion = Publicacion::findOrFail($id);
        // data from request
        $tipo_publicacion_id = $request->tipo_publicacion_id;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $main = $request->main;
        $file = $request->file;
        $image = $request->image;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($descripcion == null) {
          $descripcion = '';
        }
        // validation
        $messages = [
            'tipo_publicacion_id.required' => 'Falta seleccionar el Tipo de Publicación',
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de la Publicación ya existe',
            'main.required' => 'Falta seleccionar la Prioridad',
            'file.mimes' => 'El Archivo seleccionado no tiene una extensión válida',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'tipo_publicacion_id' => 'required',
            'titulo' => 'required|unique:comunicados,titulo,' . $id,
            'main' => 'required',
            'file' => 'nullable|mimes:pdf,PDF',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // update publicacion
        $publicacion->user_id = auth('api')->user()->id;
        $publicacion->tipo_publicacion_id = $tipo_publicacion_id;
        $publicacion->titulo = $titulo;
        $publicacion->slug = Str::slug($titulo);
        $publicacion->descripcion = $descripcion;
        $publicacion->main = $main;
        $publicacion->save();
        // udpate image
        if($request->hasFile('image')) {
            // old image
            $oldImage = $publicacion->image;
            // update image
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $publicacion->slug;
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            $upload = $image->move('archivos/imagenes/publicaciones', $imagePath);
            if($upload) {
                if($oldImage != null) {
                    $oldImage->update([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }else {
                    $publicacion->image()->create([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }
                $result = 1;
                $message = 'La Publicación se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
                $selector = 'pathEdit';
            }
        }else{
            $result = 1;
            $message = 'La Publicación se editó correctamente';
        }
        // udpate file
        if($request->hasFile('file')) {
            // old file
            $oldFile = $publicacion->file;
            // update file
            $fileName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $publicacion->slug;
            $extension = $file->getClientOriginalExtension();
            $filePath = $fileName . "." . $extension;
            $upload = $file->move('archivos/documentos/publicaciones', $filePath);
            if($upload) {
                if($oldFile != null) {
                    $oldFile->update([
                        'name' => $publicacion->slug,
                        'path' => $filePath,
                    ]);
                }else {
                    $publicacion->file()->create([
                        'name' => $publicacion->slug,
                        'path' => $filePath,
                    ]);
                }
                $result = 1;
                $message = 'La Publicación se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir el Archivo, intente de nuevo más tarde";
                $selector = 'pathEdit';
            }
        }else{
            $result = 1;
            $message = 'La Publicación se editó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Publicacion::findOrFail($id);
        $delete->delete();
        $message = 'La Publicación se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
