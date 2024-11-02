<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = Role::with('permissions')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->where('id', '!=', 1)
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')
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
            'permissions' => $permissions,
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        // data from request
        $nombre = $request->nombre;
        $permissions = $request->permissions;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Rol ya existe',
        ];
        $this->validate($request, [
            'nombre' => 'required|unique:roles,name',
        ], $messages);
        // create role
        $role = new Role;
        $role->name = $nombre;
        $role->guard_name = 'web';
        $role->save();
        // create permissions
        $role->syncPermissions($permissions);
        $result = 1;
        $message = 'El Rol se registró correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update
        $role = Role::findOrFail($id);
        // data from request
        $nombre = $request->nombre;
        $permissions = $request->permissions;
        // response data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'nombre.required' => 'Falta ingresar el nombre',
            'nombre.unique' => 'El Rol ya existe',
        ];
        $this->validate($request, [
            'nombre' => 'required|unique:roles,name,' . $id,
        ], $messages);
        // create persona
        $role->name = $nombre;
        $role->save();
        // update permissions
        $role->syncPermissions($permissions);
        $result = 1;
        $message = 'El Rol se editó correctamente';
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = Role::findOrFail($id);
        // verify any relationship
        if($delete->users()->count()) {
            $result = 0;
            $message = 'El Rol no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Rol se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
