<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\NotaVentaProducto;
use App\Models\DetalleNotaVentaProducto;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

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
        $nota_venta_producto =  
        $lista_productos =

        $nota_venta_producto = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
                                                  ->where('nota_venta_producto.id', '=', $id)
                                                  ->select('nota_venta_producto.*', 'clientes.nombre')->first();

        //dd($nota_producto); 

        $lista_productos = DetalleNotaVentaProducto::join('producto', 'detalle_nota_venta_producto.producto_id', 'producto.id')
                                                     ->where('detalle_nota_venta_producto.nota_venta_producto_id', '=', $id)
                                                     ->select('detalle_nota_venta_producto.*', 'producto.nombre','producto.precio_venta')->get();

        //dd($lista_productos); 

        return view('modulo_ventas.nota_venta_producto.show', compact('nota_venta_producto', 'lista_productos'));
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
    public function generateInvoice($nota_venta_producto_id){

        $cliente = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
                                             ->where('nota_venta_producto.id', '=', $nota_venta_producto_id)
                                             ->select('clientes.nombre','clientes.apellido')->first();

        $lista_productos = DetalleNotaVentaProducto::join('producto', 'detalle_nota_venta_producto.producto_id', 'producto.id')
                                                     ->where('detalle_nota_venta_producto.nota_venta_producto_id', '=', $nota_venta_producto_id)
                                                     ->select('detalle_nota_venta_producto.*', 'producto.nombre', 'producto.precio_venta')->get();


        $customer = new Buyer([
                'name' => $cliente->nombre . ' ' . $cliente->apellido ,
                'custom_fields' => [
                    'Nit' => '2371912',
                    'Lugar' => 'Santa Cruz',
                    'Fecha' => '08/12/2022',

                ],
            ]);

        foreach ($lista_productos as $producto) {
            $items[] = (new InvoiceItem())->title($producto->nombre)->pricePerUnit($producto->precio_venta)->quantity($producto->cantidad);
        }    

        

        $invoice = Invoice::make()
            ->buyer($customer)
            ->currencySymbol('Bs')
            ->currencyCode('USD')
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItems($items);

        return $invoice->stream();
    }
    //---------------------------------------------------------------
}
