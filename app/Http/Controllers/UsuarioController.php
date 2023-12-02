<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::paginate();

        return view('usuario.index', compact('usuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = new Usuario();
        // Obtiene los nombres de los roles y los usa como valores
        $roles = Role::pluck('name', 'name')->toArray();
        
        // Agrega el placeholder al principio del array de roles
        $rolesConPlaceholder = ['' => 'Selecciona un rol'] + $roles;
        
        return view('usuario.create', compact('usuario', 'rolesConPlaceholder'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usuarios',
        'password' => 'required|string|min:8',
        'role' => 'required' // Asegúrate de validar que se ha seleccionado un rol
    ]);

    $usuario = Usuario::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Asigna el rol seleccionado
    if ($request->role !== '') {
        $usuario->assignRole($request->role);
    } else {
        return back()->withErrors(['role' => 'Por favor selecciona un rol válido.']);
    }

    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario Creado Exitosamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return view('usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        // Obtiene los nombres de los roles y los usa como valores
        $roles = Role::pluck('name', 'name')->toArray();
        
        // Agrega el placeholder al principio del array de roles
        $rolesConPlaceholder = ['' => 'Selecciona el rol'] + $roles;
        
        // Determina el rol actual del usuario para seleccionarlo por defecto
        $currentRole = $usuario->roles->first() ? $usuario->roles->first()->name : '';
    
        return view('usuario.edit', compact('usuario', 'rolesConPlaceholder', 'currentRole'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        // Validar el request
        $request->validate(Usuario::$rules);
    
        // Iniciar un array con los datos a actualizar
        $input = $request->all();
    
        // Verificar si se proporcionó una contraseña en el formulario
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            // Si no se cambió la contraseña, se elimina del array para no actualizarla
            unset($input['password']);
        }
    
        // Actualizar el usuario con los datos filtrados
        $usuario->update($input);
    
        // Si se ha seleccionado un rol, actualizar el rol del usuario
        if (!empty($request->role)) {
            $usuario->syncRoles($request->role);
        } else {
            return back()->withErrors(['role' => 'Por favor selecciona un rol válido.']);
        }
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario Actualizado Exitosamente');
    }
    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario Eliminado Exitosamente');
    }
}
