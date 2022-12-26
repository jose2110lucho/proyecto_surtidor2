<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\NotaVentaCombustible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bomba;
use App\Models\Tanque;
use App\Models\UserBomba;
use App\Models\Combustible;

use DateTime;
use DateTimeZone;

class NotaVentaCombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_nota_venta_combustible = NotaVentaCombustible::join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
        ->join('clientes','vehiculos.cliente_id','clientes.id')
        ->select('nota_venta_combustible.*', 'vehiculos.placa','clientes.nombre')->orderBy('fecha','desc')->get();
        return view('modulo_ventas.nota_venta_combustible.index', compact('lista_nota_venta_combustible'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $bomba_id = UserBomba::where('user_id', '=', $user->id)->orderBy('fecha_asignacion', 'desc')->first()->bomba_id;
        $bomba = Bomba::find($bomba_id);
        $tanque = Tanque::where('id', '=', $bomba->tanque_id)->first();
        $combustible = Combustible::find($tanque->combustible_id);
        $lista_vehiculos = Vehiculo::all();
        
        return view('modulo_ventas/nota_venta_combustible/create',['lista_vehiculos'=>$lista_vehiculos,'bomba'=>$bomba,'tanque'=>$tanque,'combustible'=>$combustible]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_hora = new DateTime();  
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s"); 
        $vehiculo_array = explode("`", $request->vehiculo_id);
        $vehiculo_id = $vehiculo_array[0];

        if ($vehiculo_id == "0") {
            return redirect('nota_venta_combustible/create');
        } else {
            
            $tanque = Tanque::find($request->tanque_id);
            if($tanque->cantidad_disponible - $request->cantidad_combustible > 0){

                $nota_venta_combustible = new NotaVentaCombustible();
                $nota_venta_combustible->fecha =  $DateAndTime;
                $nota_venta_combustible->total = $request->cantidad_combustible * $request->precio;
                $nota_venta_combustible->cantidad_combustible = $request->cantidad_combustible;
                $nota_venta_combustible->vehiculo_id = $vehiculo_id;
                $nota_venta_combustible->save();

                $tanque->cantidad_disponible = $tanque->cantidad_disponible - $request->cantidad_combustible;
                $tanque->save();

                if($nota_venta_combustible->total >= 100){

                    $vehiculo = Vehiculo::find($vehiculo_id);
                    $cliente = Cliente::find($vehiculo->cliente_id);
                    $cliente->puntos =  $cliente->puntos + 1;
                    $cliente->save();
                }

                

                return redirect('nota_venta_combustible');
            }else{
                return redirect()->route('nota_venta_combustible.create')->with('mensaje', 'cantidad de combustible insuficiente, disponible: '.$tanque->cantidad_disponible.' litros');
            }
     
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $bomba_id = UserBomba::where('user_id', '=', $user->id)->orderBy('fecha_asignacion', 'desc')->first()->bomba_id;
        $bomba = Bomba::find($bomba_id);
        $tanque = Tanque::where('id', '=', $bomba->tanque_id)->first();
        $combustible = Combustible::find($tanque->combustible_id);

        $nota_venta_combustible = NotaVentaCombustible::join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
        ->join('clientes','vehiculos.cliente_id','clientes.id')
        ->where('nota_venta_combustible.id','=',$id)
        ->select('nota_venta_combustible.*', 'vehiculos.placa','clientes.nombre')->first();
        
        return view('modulo_ventas.nota_venta_combustible.show', compact('nota_venta_combustible','bomba','tanque','combustible'));
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
}
