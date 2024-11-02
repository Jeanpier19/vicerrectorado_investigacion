<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Video;
use Validator;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Video::where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            })
            ->orderBy('main', 'desc')
            ->latest('updated_at')
            ->paginate(3);
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
        $update = Video::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Video se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Video se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $titulo = $request->titulo;
        $frame = $request->frame;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de Video ya existe',
            'frame.required' => 'Falta ingresar el Frame',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'titulo' => 'required|unique:videos,titulo',
            'frame' => 'required',
            'main' => 'required',
        ], $messages);
        // create video
        $video = new Video;
        $video->user_id = auth('api')->user()->id;
        $video->titulo = $titulo;
        $video->slug = Str::slug($titulo);
        $video->frame = $frame;
        $video->main = $main;
        $video->active = 1;
        $video->save();
        $result = 1;
        $message = 'El Video se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // video
        $video = Video::findOrFail($id);
        // data from request
        $titulo = $request->titulo;
        $frame = $request->frame;
        $main = $request->main;
        // reponse data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'titulo.required' => 'Falta ingresar el Título',
            'titulo.unique' => 'El título de la Video ya existe',
            'frame.required' => 'Falta ingresar el Frame',
            'main.required' => 'Falta seleccionar la Prioridad'
        ];
        $this->validate($request, [
            'titulo' => 'required|unique:videos,titulo,' . $id,
            'frame' => 'required',
            'main' => 'required',
        ], $messages);
        // create video
        $video->user_id = auth('api')->user()->id;
        $video->titulo = $titulo;
        $video->slug = Str::slug($titulo);
        $video->frame = $frame;
        $video->main = $main;
        $video->save();
        $result = 1;
        $message = 'El Video se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Video::findOrFail($id);
        // verify any relationship
        $delete->delete();
        $message = 'El Video se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
