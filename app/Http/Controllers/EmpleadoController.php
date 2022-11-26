<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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

        return view('modulo_administrativo/empleados/index', ['user' => $user]);
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
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        $image = $request->file('foto_perfil'); //image file from frontend  
        $firebase_storage_path = 'Users/';
        $localfolder = public_path('firebase-temp-uploads') . '/';
        $extension = $request->file('foto_perfil')->getClientOriginalExtension();
        $file      = $user->id . '.' . $extension;

        if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder . $file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);

            $user->update(['foto_perfil' => $firebase_storage_path . $file]);
            unlink($localfolder . $file);
        }
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
        $usuario = User::find($id);

        $image = asset('/img/user-default.jpeg');
        if ($usuario->foto_perfil) {
            $expiresAt = Carbon::now()->addSeconds(5);
            $imageReference = app('firebase.storage')->getBucket()->object($usuario->foto_perfil);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            };
        }
        return view('modulo_administrativo.empleados.show', compact('usuario', 'image'));
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
        return view('modulo_administrativo.empleados.edit', compact('user', 'roles'));
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
        $user = User::find($id);
        if ($request->hasfile('foto_perfil')) {

            if ($user->foto_perfil) {
                if (app('firebase.storage')->getBucket()->object($user->foto_perfil)->exists()) {
                    app('firebase.storage')->getBucket()->object($user->foto_perfil)->delete();
                }
                $user->update(['foto_perfil' => null]);
            }

            $image = $request->file('foto_perfil');
            $firebase_storage_path = 'Users/';
            $extension = $image->getClientOriginalExtension();
            $file = $user->id . '.' . $extension;
            $localfolder = public_path('firebase-temp-uploads') . '/';

            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                $user->update((['foto_perfil' => $firebase_storage_path . $file]));
                unlink($localfolder . $file);
            }
        }
        $user->update($request->except(['foto_perfil']));
        $user->roles()->sync($request->role);
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
        $user = User::find($id);
        if ($user->foto_perfil) {
            app('firebase.storage')->getBucket()->object($user->foto_perfil)->delete();
        }
        User::destroy($id);
        return redirect('empleados');
    }
}
