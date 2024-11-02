<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Banner::with('image')
            ->where(function ($query) use ($search) {
                $query->where('link', 'like', '%' . $search . '%');
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
            'items' => $items
        ];
        return response()->json($response);
    }

    public function enable_disable($active, $id)
    {
        // response data
        $result = 1;
        $message = '';
        // update
        $update = Banner::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Banner se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Banner se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $link = $request->link;
        $main = $request->main;
        $image = $request->image;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($link == null) {
          $link = '';
        }
        // validation
        $messages = [
            'link.url' => 'El Enlace no es un link válido',
            'main.required' => 'Falta seleccionar la prioridad',
            'image.required' => 'Falta seleccionar la imagen',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'link' => 'nullable|url',
            'main' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // create banner
        $banner = new Banner;
        $banner->user_id = auth('api')->user()->id;
        $banner->link = $link;
        $banner->main = $main;
        $banner->active = 1; 
        $banner->save();
        // create image
        if($request->hasFile('image')) {
            // image name
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $banner->id;
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            // upload image
            $upload = $image->move('archivos/imagenes/banners', $imagePath);
            if($upload) {
                $banner->image()->create([
                    'name' => $imageName,
                    'path' => $imagePath,
                    'main' => 1,
                ]);
                $result = 1;
                $message = 'El Banner se registró correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'El Banner se registró correctamente';
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
        $banner = Banner::findOrFail($id);
        // data from request
        $link = $request->link;
        $main = $request->main;
        $image = $request->image;
        // response data
        $result = 1;
        $message = '';
        // null data
        if($link == null) {
          $link = '';
        }
        // validation
        $messages = [
            'link.url' => 'El Enlace no es un link válido',
            'image.required' => 'Falta seleccionar la imagen',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'link' => 'nullable|url',
            'main' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // update banner
        $banner->user_id = auth('api')->user()->id;
        $banner->link = $link;
        $banner->main = $main;
        $banner->save();
        // udpate image
        if($request->hasFile('image')) {
            // old image
            $oldImage = $banner->image;
            // update image
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . $banner->id;
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            $upload = $image->move('archivos/imagenes/banners', $imagePath);
            if($upload) {
                if($oldImage != null) {
                    $oldImage->update([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }else {
                    $banner->image()->create([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }
                $result = 1;
                $message = 'El Banner se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
                $selector = 'pathEdit';
            }
        }else{
            $result = 1;
            $message = 'El Banner se editó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // response data
        $result = 1;
        $message = '';
        // delete
        $delete = Banner::findOrFail($id);
        $delete->delete();
        $message = 'El Banner se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
