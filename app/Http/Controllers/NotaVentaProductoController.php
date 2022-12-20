<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\NotaVentaProducto;
use App\Models\DetalleNotaVentaProducto;
use App\Models\FacturaProducto;



use DateTime;
use DateTimeZone;

class NotaVentaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_nota_venta_producto = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
        ->select('nota_venta_producto.*', 'clientes.nombre')->get();
        return view('modulo_ventas/nota_venta_producto/index', ['lista_nota_venta_producto' => $lista_nota_venta_producto]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $lista_productos = Producto::where('estado', '=' ,true)->select('*')->get();
       $lista_clientes =  Cliente::where('estado', '=' ,true)->select('*')->get();
       return view('modulo_ventas/nota_venta_producto/create',['lista_productos'=>$lista_productos,'lista_clientes'=>$lista_clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_id = $request->cliente_id;
        $producto_list = $request->producto_list;
        $total = $request->total;
        $fecha_hora = new DateTime();  
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s"); 
        

        $nota_venta_producto =  new NotaVentaProducto();
        $nota_venta_producto->cliente_id = $cliente_id;
        $nota_venta_producto->fecha=$DateAndTime;
        $nota_venta_producto->total=$total;
        $nota_venta_producto->save();
        
        

        foreach ($producto_list as $producto) {
            $refill = Producto::find($producto['producto_id']);
            if( $producto['cantidad'] <= $refill->cantidad){
                $detalle_producto = new DetalleNotaVentaProducto();
                $detalle_producto->cantidad=$producto['cantidad'];
                $detalle_producto->nota_venta_producto_id = $nota_venta_producto->id;
                $detalle_producto->producto_id = $producto['producto_id'];
                $detalle_producto->save();

                $refill->cantidad = $refill->cantidad - $producto['cantidad'];
                if($refill->cantidad < 1){
                    $refill->estado = false;
                }

                $refill->save();
            }
            
        }
    
        return $nota_venta_producto->id;  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $nota_venta_producto = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
                                                  ->where('nota_venta_producto.id', '=', $id)
                                                  ->select('nota_venta_producto.*', 'clientes.nombre')->first();


        $lista_productos = DetalleNotaVentaProducto::join('producto', 'detalle_nota_venta_producto.producto_id', 'producto.id')
                                                     ->where('detalle_nota_venta_producto.nota_venta_producto_id', '=', $id)
                                                     ->select('detalle_nota_venta_producto.*', 'producto.nombre','producto.precio_venta')->get();


        $listaFacturaProducto = FacturaProducto::where('nota_venta_producto_id','=',$id)->select('*')->get();
        
        $existeFactura = count($listaFacturaProducto) > 0 ? true : false;

        return view('modulo_ventas.nota_venta_producto.show', compact('nota_venta_producto', 'lista_productos','existeFactura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //---------------------------------------------------------------
    
    //---------------------------------------------------------------
}
