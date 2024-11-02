<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Investigador;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');   
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $items = User::with('image', 'persona', 'roles')
            ->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%');
            })
            ->where('status', '!=', 2)
            ->where('id', '!=', 1)
            ->where('id', '!=', Auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $roles = Role::orderBy('name')
            ->where('id', '!=', 1)
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
            'roles' => $roles,
        ];
        return response()->json($response);
    }

    public function enable_disable($status, $id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // update
        $update = User::findOrFail($id);
        $update->status = $status;
        $update->save();
        // response message
        if($status == 0) {
            $message = 'El Usuario se desactivó correctamente';
        }elseif($status == 1) {
            $message = 'El Usuario se activó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function store(Request $request)
    {
        // data from request
        $dni = $request->dni;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $genero = $request->genero;
        $email = $request->email;
        $telefono = $request->telefono;
        $celular = $request->celular;
        $role = $request->role;
        $image = $request->image;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($email == null) {
          $email = '';
        }
        if($telefono == null) {
          $telefono = '';
        }
        if($celular == null) {
          $celular = '';
        }
        // additional data not required
        $direccion = '';
        $facebook = '';
        $twitter = '';
        $instagram = '';
        $linkedin = '';
        $github = '';
        $sitio_web = '';
        // validation
        $messages = [
            'dni.required' => 'Falta ingresar el N° de DNI',
            'dni.digits' => 'El N° de DNI debe ser un número de 8 dígitos',
            'dni.unique' => 'El DNI ya existe',
            'nombres.required' => 'Falta ingresar los nombres',
            'apellidos.required' => 'Falta ingresar los apellidos',
            'genero.required' => 'Falta seleccionar el género',
            'email.email' => 'El email no tiene un formato correcto',
            'role.required' => 'Falta seleccionar el rol',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'dni' => 'required|digits:8|unique:personas,dni',
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'email' => 'nullable|email',
            'role' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // create persona
        $persona = new Persona;
        $persona->dni = $dni;
        $persona->nombres = $nombres;
        $persona->apellidos = $apellidos;
        $persona->genero = $genero;
        $persona->email = $email;
        $persona->telefono = $telefono;
        $persona->celular = $celular;
        $persona->direccion = '';
        $persona->facebook = '';
        $persona->twitter = '';
        $persona->instagram = '';
        $persona->linkedin = '';
        $persona->github = '';
        $persona->sitio_web = '';
        $persona->save();
        // create user
        $user = new User;
        $user->username = $dni;
        $user->password = bcrypt($dni);
        $user->persona_id = $persona->id;
        $user->status = 1;
        $user->save();
        // create role
        $user->syncRoles($role);
        // create image
        if($request->hasFile('image')) {
            // image name
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . Str::slug($user->username);
            $extension = $image->getClientOriginalExtension();
            $imagePath = $imageName . "." . $extension;
            // upload image
            $upload = $image->move('archivos/imagenes/usuarios', $imagePath);
            if($upload) {
                $user->image()->create([
                    'name' => $imageName,
                    'path' => $imagePath,
                    'main' => 1,
                ]);
                $result = 1;
                $message = 'El Usuario se registró correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
            }
        }else {
            $result = 1;
            $message = 'El Usuario se registró correctamente';
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
        $user = User::findOrFail($id);
        $persona = Persona::findOrFail($user->persona->id);
        // data from request
        $dni = $request->dni;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $genero = $request->genero;
        $email = $request->email;
        $telefono = $request->telefono;
        $celular = $request->celular;
        $role = $request->role;
        $image = $request->image;
        // reponse data
        $result = 1;
        $message = '';
        // null data
        if($email == null) {
          $email = '';
        }
        if($telefono == null) {
          $telefono = '';
        }
        if($celular == null) {
          $celular = '';
        }
        // validation
        $messages = [
            'dni.required' => 'Falta ingresar el N° de DNI',
            'dni.digits' => 'El N° de DNI debe ser un número de 8 dígitos',
            'dni.unique' => 'El DNI ya existe',
            'nombres.required' => 'Falta ingresar los nombres',
            'apellidos.required' => 'Falta ingresar los apellidos',
            'genero.required' => 'Falta seleccionar el género',
            'email.email' => 'El email no tiene un formato correcto',
            'role.required' => 'Falta seleccionar el rol',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'dni' => 'required|digits:8|unique:personas,dni,' . $persona->id,
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'email' => 'nullable|email',
            'role' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // update persona
        $persona->dni = $dni;
        $persona->nombres = $nombres;
        $persona->apellidos = $apellidos;
        $persona->genero = $genero;
        $persona->email = $email;
        $persona->telefono = $telefono;
        $persona->celular = $celular;
        $persona->save();
        // update role
        $user->syncRoles($role);
        // udpate image
        if($request->hasFile('image')) {
            // old image
            $oldImage = $user->image;
            // update image
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . Str::slug($user->username);
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
                    $user->image()->create([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }
                $result = 1;
                $message = 'El Usuario se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
                $selector = 'pathEdit';
            }
        }else{
            $result = 1;
            $message = 'El Usuario se editó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }

    public function destroy($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        // delete
        $delete = User::findOrFail($id);
        // verify any relationship
        if($delete->investigador()->count()) {
            $result = 0;
            $message = 'El Usuario no se puede eliminar porque tiene registros relacionados';
        }else {
            $delete->delete();
            $message = 'El Usuario se eliminó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    function generateRandomString($length) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 
    public function password_reset($id)
    {
        // reponse data
        $result = 1;
        $message = '';
        $new_password = $this->generateRandomString(8);
        // update
        $update = User::findOrFail($id);
        $update->password = bcrypt($new_password);
        $update->save();
        $message = 'La contraseña se restableció correctamente';
        return response()->json(["result" => $result, 'message' => $message, 'name' => $update->persona->nombres . ' ' . $update->persona->apellidos, 'username' => $update->username, 'new_password' => $new_password]);
    }
    // Perfil
    public function get_profile_data() {
        $user = User::where('id', auth('api')->user()->id)
            ->with('image', 'persona', 'investigador')
            ->first();
        $response = [
            'user' => $user,
        ];
        return response()->json($response);
    }
    public function update_profile(Request $request) {
        // data from request
        $user_id = $request->id;
        $genero = $request->genero;
        $email = $request->email;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $telefono = $request->telefono;
        $celular = $request->celular;
        $direccion = $request->direccion;
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $instagram = $request->instagram;
        $linkedin = $request->linkedin;
        $github = $request->github;
        $sitio_web = $request->sitio_web;
        $username = $request->username;
        $password = $request->password;
        $password_actual = $request->password_actual;
        // null data
        if($email == null) {
          $email = '';
        }
        if($fecha_nacimiento == null) {
          $fecha_nacimiento = '';
        }
        if($telefono == null) {
          $telefono = '';
        }
        if($celular == null) {
          $celular = '';
        }
        if($direccion == null) {
          $direccion = '';
        }
        if($facebook == null) {
          $facebook = '';
        }
        if($twitter == null) {
          $twitter = '';
        }
        if($instagram == null) {
          $instagram = '';
        }
        if($linkedin == null) {
          $linkedin = '';
        }
        if($github == null) {
          $github = '';
        }
        if($sitio_web == null) {
          $sitio_web = '';
        }
        // update
        $user = User::findOrFail($user_id);
        $persona = Persona::findOrFail($user->persona->id);
        // reponse data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'genero.required' => 'Falta seleccionar el género',
            'email.email' => 'El Email no tiene un formato correcto',
            'fecha_nacimiento.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
            'facebook.url' => 'El enlace a Facebook no es un link válido',
            'twitter.url' => 'El enlace a Twitter no es un link válido',
            'instagram.url' => 'El enlace a Instagram no es un link válido',
            'linkedin.url' => 'El enlace a LinkedIn no es un link válido',
            'github.url' => 'El enlace a GitHub no es un link válido',
            'username.required' => 'Falta ingresar su Usuario',
            'username.unique' => 'El Usuario ya existe',
        ];
        $this->validate($request, [
            'genero' => 'required',
            'email' => 'nullable|email',
            'fecha_nacimiento' => 'nullable|date_format:"Y-m-d"',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'username' => 'required|unique:users,username,' . $user->id,
        ], $messages);
        // update persona
        $persona->genero = $genero;
        if($fecha_nacimiento != '') {
            $persona->fecha_nacimiento = $fecha_nacimiento;
        }else {
            $persona->fecha_nacimiento = null;
        }
        $persona->email = $email;
        $persona->telefono = $telefono;
        $persona->celular = $celular;
        $persona->direccion = $direccion;
        $persona->facebook = $facebook;
        $persona->twitter = $twitter;
        $persona->instagram = $instagram;
        $persona->linkedin = $linkedin;
        $persona->github = $github;
        $persona->sitio_web = $sitio_web;
        $persona->save();
        // update user
        $user->username = $username;
        $user->save();
        if($password != null || $password_actual != null) {
            // update password
            if(Hash::check($password_actual, $user->password)) {
                $user->password = bcrypt($password);
                $user->save();
                // update investigador
                $fecha_inicio = $request->fecha_inicio;
                $grado = $request->grado;
                $categoria = $request->categoria;
                $cti = $request->cti;
                $orcid = $request->orcid;
                // null data
                if($fecha_inicio == null) {
                  $fecha_inicio = '';
                }
                if($user->investigador) {
                    $investigador = Investigador::findOrFail($user->investigador->id);
                    // validation
                    $messages = [
                        'fecha_inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
                        'grado.required' => 'Falta seleccionar su Grado Académico',
                        'categoria.required' => 'Falta seleccionar su Categoría',
                        'cti.required' => 'Falta ingresar el link a su CTI',
                        'cti.url' => 'El enlace a su CTI no es un link válido',
                        'orcid.required' => 'Falta ingresar su ID de ORCID',
                    ];
                    $this->validate($request, [
                        'fecha_inicio' => 'nullable|date_format:"Y-m-d"',
                        'grado' => 'required',
                        'categoria' => 'required',
                        'cti' => 'required|url',
                        'orcid' => 'required',
                    ], $messages);
                    if($fecha_inicio != '') {
                        $investigador->fecha_inicio = $fecha_inicio;
                    }else {
                        $investigador->fecha_inicio = null;
                    }
                    $investigador->grado = $grado;
                    $investigador->categoria = $categoria;
                    $investigador->cti = $cti;
                    $investigador->orcid = $orcid;
                    $investigador->save();
                    $message = 'Sus datos se actualizaron correctamente';
                }else {
                    $message = 'Sus datos se actualizaron correctamente';
                }
                $result = 1;
                $message = 'Sus datos y Contraseña se actualizaron correctamente';
            }else {
                $result = 0;
                $message = 'La Contraseña ingresada no coincide con su Contraseña actual';
            }
        }else {
            // update investigador
            $fecha_inicio = $request->fecha_inicio;
            $grado = $request->grado;
            $categoria = $request->categoria;
            $cti = $request->cti;
            $orcid = $request->orcid;
            // null data
            if($fecha_inicio == null) {
              $fecha_inicio = '';
            }
            if($user->investigador) {
                $investigador = Investigador::findOrFail($user->investigador->id);
                // validation
                $messages = [
                    'fecha_inicio.date_format' => 'Ingrese una fecha válida con el formato: día/mes/año',
                    'grado.required' => 'Falta seleccionar su Grado Académico',
                    'categoria.required' => 'Falta seleccionar su Categoría',
                    'cti.required' => 'Falta ingresar el link a su CTI',
                    'cti.url' => 'El enlace a su CTI no es un link válido',
                    'orcid.required' => 'Falta ingresar su ID de ORCID',
                ];
                $this->validate($request, [
                    'fecha_inicio' => 'nullable|date_format:"Y-m-d"',
                    'grado' => 'required',
                    'categoria' => 'required',
                    'cti' => 'required|url',
                    'orcid' => 'required',
                ], $messages);
                if($fecha_inicio != '') {
                    $investigador->fecha_inicio = $fecha_inicio;
                }else {
                    $investigador->fecha_inicio = null;
                }
                $investigador->grado = $grado;
                $investigador->categoria = $categoria;
                $investigador->cti = $cti;
                $investigador->orcid = $orcid;
                $investigador->save();
                $result = 1;
                $message = 'Sus datos se actualizaron correctamente';
            }else {
                $result = 1;
                $message = 'Sus datos se actualizaron correctamente';
            }
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
    public function update_profile_picture(Request $request) {
        // update
        $user = User::findOrFail(auth('api')->user()->id);
        // data from request
        $image = $request->image;
        // reponse data
        $result = 1;
        $message = '';
        // validation
        $messages = [
            'image.required' => 'Falta seleccionar la imagen',
            'image.image' => 'La imagen seleccionada no es una imagen válida',
            'image.mimes' => 'La imagen seleccionada no tiene una extensión válida',
        ];
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg,PNG,JPG,JPEG',
        ], $messages);
        // udpate image
        if($request->hasFile('image')) {
            // old image
            $oldImage = $user->image;
            // update image
            $imageName = date('d-m-Y') . '-' . date('H-i-s') . '-' . Str::slug($user->username);
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
                    $user->image()->create([
                        'name' => $imageName,
                        'path' => $imagePath,
                        'main' => 1,
                    ]);
                }
                $result = 1;
                $message = 'La Foto del Usuario se editó correctamente';
            }else {
                $result = 0;
                $message = "Error al subir la imagen, intente de nuevo más tarde";
            }
        }else{
            $result = 1;
            $message = 'La Foto del Usuario se editó correctamente';
        }
        return response()->json(["result" => $result, 'message' => $message]);
    }
}
