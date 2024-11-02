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

class SolicitudCreacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Investigador::with('user.persona', 'departamento.facultad')
            ->where(function ($query) use ($search) {
                $query->where('grado', 'like', '%' . $search . '%');
            })
            ->whereHas('user', function($query) {
                $query->where('status', 2);
            })
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

    public function verify($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $investigador = Investigador::findOrFail($id);
        $investigador->active = 1;
        $investigador->save();
        $user = User::findOrFail($investigador->user_id);
        $user->status = 1;
        $user->save();
        // response message
        $message = 'El Investigador se verificó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
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
        // 
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $investigador = Investigador::findOrFail($id);
        $user = User::findOrFail($investigador->user_id);
        $persona = Persona::findOrFail($user->persona_id);
        $investigador->forceDelete();
        $user->forceDelete();
        $persona->forceDelete();
        $message = 'La Solicitud se eliminó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
