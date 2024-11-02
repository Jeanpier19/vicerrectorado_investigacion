<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Investigador;
use App\User;
use App\Persona;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use DB;

class InvestigadorRenacytController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Investigador::with('user.image', 'user.persona', 'departamento.facultad')
            ->where(function ($query) use ($search) {
                $query->where('grado', 'like', '%' . $search . '%');
            })
            ->whereHas('user', function($query) {
                $query->where('status', '!=', 2);
            })
            ->where('estado', '=', 2)
            ->where('id', '!=', 1)
            ->where('id', '!=', Auth()->user()->id)
            ->orderBy('id', 'DESC')
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
        $update = Investigador::findOrFail($id);
        $update->active = $active;
        $update->save();
        // response message
        if($active == 0) {
            $message = 'El Investigador se desactivó correctamente';
        }elseif($active == 1) {
            $message = 'El Investigador se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function search_user(Request $request) {
        // data from request
        $search = $request->search;
        // response data
        $result = 1;
        $message = '';
        // investigadores
        $investigadores = Investigador::with('user')
            ->get(); 
         foreach($investigadores as $item) {
            $investigadores_id[] = $item->user->id;
        } 
        $users = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.id', DB::raw('CONCAT(users.username, " - ", personas.dni, " - ", personas.nombres, " ", personas.apellidos) AS user'))
            ->where('users.status', 1)
            // ->whereNotIn('users.id', $investigadores_id)
            ->where(function($query) use ($search) {
                $query->where('users.username', 'like', '%' . $search . '%')
                    ->orWhere('personas.dni', 'like', '%' . $search . '%')
                    ->orWhere('personas.nombres', 'like', '%' . $search . '%')
                    ->orWhere('personas.apellidos', 'like', '%' . $search . '%')
                    ->orWhere(DB::raw('CONCAT(personas.nombres, " ", personas.apellidos)'), 'like', '%' . $search . '%')
                    ->orWhere(DB::raw('CONCAT(personas.apellidos, " ", personas.nombres)'), 'like', '%' . $search . '%');
            })
            ->get();
        $response = [
            'users' => $users,
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        // data from request
        $user_id = $request->user_id;
        $fecha_inicio = $request->fecha_inicio;
        $grado = $request->grado;
        $categoria = $request->categoria;
        $cti = $request->cti;
        $orcid = $request->orcid;
        $departamento_id = $request->departamento_id;
        $main = $request->main;
        $image = $request->image;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($fecha_inicio == null) {
          $fecha_inicio = '';
        }
        if($grado == null) {
          $grado = '';
        }
        if($cti == null) {
          $cti = '';
        }
        if($orcid == null) {
          $orcid = '';
        }
        // additional data not required
        $hoja_vida = '';
        // validation
        $messages = [
            'user_id.required' => 'Falta buscar un Usuario',
            'fecha_inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'categoria.required' => 'Falta seleccionar la Categoría',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'departamento_id.required' => 'Falta seleccionar el Departamento Académico',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'user_id' => 'required',
            'fecha_inicio' => 'nullable|date_format:"Y-m-d"',
            'categoria' => 'required',
            'facultad_id' => 'required',
            'departamento_id' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // create investigador
        $investigador = new Investigador;
        $investigador->departamento_id = $departamento_id;
        $investigador->user_id = $user_id;
        if($fecha_inicio != '') {
            $investigador->fecha_inicio = $fecha_inicio;
        }else {
            $investigador->fecha_inicio = null;
        }
        $investigador->hoja_vida = $hoja_vida;
        $investigador->grado = $grado;
        $investigador->categoria = $categoria;
        $investigador->cti = $cti;
        $investigador->orcid = $orcid;
        $investigador->main = $main;
        $investigador->active = 1;
        $investigador->estado = 2; //estado 1 = investigador ; estado 2 = investigador renacyt
        $investigador->save();
        // create image
        if($request->hasFile('image')) {
            // image name
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . Str::slug($investigador->user->username);
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            // upload image
            $upload = $image->move('archivos/imagenes/usuarios', $imagePath);
            if($upload) {
                $investigador->user->image()->create([
                    'name' => $imageName,
                    'path' => $imagePath,
                    'main' => 1,
                ]);
                $result = 1;
                $message = 'El Investigador se registró correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'El Investigador se registró correctamente';
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
        $investigador = Investigador::findOrFail($id);
        // data from request
        $user_id = $request->user_id;
        $fecha_inicio = $request->fecha_inicio;
        $grado = $request->grado;
        $categoria = $request->categoria;
        $cti = $request->cti;
        $orcid = $request->orcid;
        $departamento_id = $request->departamento_id;
        $main = $request->main;
        $image = $request->image;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($fecha_inicio == null) {
          $fecha_inicio = '';
        }
        if($grado == null) {
          $grado = '';
        }
        if($cti == null) {
          $cti = '';
        }
        if($orcid == null) {
          $orcid = '';
        }
        // validation
        $messages = [
            'fecha_inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'categoria.required' => 'Falta seleccionar la Categoría',
            'facultad_id.required' => 'Falta seleccionar la Facultad',
            'departamento_id.required' => 'Falta seleccionar el Departamento Académico',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'fecha_inicio' => 'nullable|date_format:"Y-m-d"',
            'categoria' => 'required',
            'facultad_id' => 'required',
            'departamento_id' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // update investigador
        $investigador->departamento_id = $departamento_id;
        if($fecha_inicio != '') {
            $investigador->fecha_inicio = $fecha_inicio;
        }else {
            $investigador->fecha_inicio = null;
        }
        $investigador->grado = $grado;
        $investigador->categoria = $categoria;
        $investigador->cti = $cti;
        $investigador->orcid = $orcid;
        $investigador->main = $main;
        $investigador->save();
        // udpate image
        if($request->hasFile('image')) {
            // old image
            $oldImage = $investigador->user->image;
            // update image
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . Str::slug($investigador->user->username);
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            $upload = $image->move('archivos/imagenes/usuarios', $imagePath);
            if($upload) {
                if($oldImage != null) {
                    $oldImage->update([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }else {
                    $investigador->user->image()->create([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }
                $result = 1;
                $message = 'El Investigador se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
                $selector = 'pathEdit';
            }
        }else{
            $result = 1;
            $message = 'El Investigador se editó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Investigador::findOrFail($id);
        // verify any relationship
        if($delete->proyectos()->count()) {
            $result = 0;
            $message = 'El Investigador no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Investigador se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
