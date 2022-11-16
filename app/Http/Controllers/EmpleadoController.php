<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('modulo_administrativo/empleados/index',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_administrativo/empleados/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->password = Hash::make($request->password);
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->estado = true;
        $user->save();

       return redirect('/empleados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $usuario = User::findOrFail($id);
        return view('modulo_administrativo.empleados.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();       
        $user = User::find($id); 
        return view('modulo_administrativo.empleados.edit',compact('user','roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /* user=User::find($id);
    user->update([
    'Name'=>$request->name
    .
    .
    .
    .
    ]);
    $user = request()->except(['_token','_method']);
        $user=User::find($id);
        $user->roles()->attach($request->rol);
        return redirect()->route('admin.users.edit', $user);
     */
    public function update(Request $request, int $id)
    {
        /* $user = request()->except(['_token','_method']); */
        $user=User::find($id);
        $user->update($request->all());
        
        /* $user->roles()->attach($request->all()); */
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('empleados');
    }
}
