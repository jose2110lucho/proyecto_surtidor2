<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\View\ViewServiceProvider;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_productos = Producto::all();
       return view('modulo_inventario/producto/index',['lista_productos'=>$lista_productos]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('modulo_inventario/producto/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        if($request->hasfile('nombre_imagen')){

            $file = $request->file('nombre_imagen');
            $destinationPath = 'img/nombre_imagen/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('nombre_imagen')->move($destinationPath, $filename);
            $producto->nombre_imagen = $destinationPath . $filename;
         }

        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->cantidad = $request->cantidad; 
        $producto->estado = true;
        $producto->descripcion = $request->descripcion;
       // $producto->nombre_imagen = $request-> hasfile('nombre_imagen');

        

        $producto->save();

       return redirect('/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id); 
        return view('modulo_inventario.producto.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id); 
        return view('modulo_inventario.producto.edit',compact('producto')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // $datosProducto = request()->except(['_token','_method']);
       // Producto::where('id','=',$id)->update($datosProducto);
       // return redirect('/producto')->with('status', 'Producto Actualizado Exitosamente!'); 
        
        $nombre_imagen = "";
        $lista = [];
        if($request->hasfile('nombre_imagen')){

            $file = $request->file('nombre_imagen');
            $destinationPath = 'img/nombre_imagen/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('nombre_imagen')->move($destinationPath, $filename);
            $nombre_imagen = $destinationPath . $filename;

         }

         $lista = [

            "nombre" => $request->nombre,
            "precio_compra" => $request->precio_compra,
            "precio_venta"  =>$request->precio_venta,
            "estado" => $request->estado,
            "cantidad" => $request->cantidad, 
            "descripcion" => $request->descripcion,
         ];

         if($nombre_imagen != ""){

            $lista["nombre_imagen"] = $nombre_imagen;
         }
         Producto::where('id','=',$id)->update($lista);
         return redirect('/producto')->with('status', 'Producto Actualizado Exitosamente!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect('producto');
    }
}
