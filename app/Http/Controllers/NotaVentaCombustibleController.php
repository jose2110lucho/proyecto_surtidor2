<?php

namespace App\Http\Controllers;

use App\Exports\VentasCombustiblesExport;
use App\Http\Traits\ReporteTrait;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\NotaVentaCombustible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bomba;
use App\Models\Tanque;
use App\Models\UserBomba;
use App\Models\Combustible;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NotaVentaCombustibleController extends Controller
{
    use ReporteTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $nota_venta_combustible = DB::table('nota_venta_combustible')
                ->join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
                ->join('clientes', 'vehiculos.cliente_id', 'clientes.id')
                ->select(['nota_venta_combustible.*', 'clientes.nombre as cliente', 'vehiculos.placa',]);

            return DataTables::of($nota_venta_combustible)
                ->addColumn('actions', 'modulo_ventas.nota_venta_combustible.partials.actions')
                ->rawColumns(['actions'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('buscar') && !empty($request->get('buscar'))) {
                        $query->where('clientes.nombre', 'ilike', "%" . $request->get('buscar') . "%");
                    }
                    if (!empty($request->get('start_date')) && !empty($request->get('end_date'))) {
                        $end_date = Carbon::create($request->get('end_date'));
                        $query->where('fecha', '>=', $request->get('start_date'))->where('fecha', '<=', $end_date->addDay());
                    }
                })->toJson();
        }
        return view('modulo_ventas.nota_venta_combustible.reportes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $user_bomba = UserBomba::where('user_id', '=', $user->id)->orderBy('fecha_asignacion', 'desc')->get();
        if(count($user_bomba) == 0){
            return view('modulo_ventas/nota_venta_combustible/create',['sin_bomba_asignada'=>true]);
        }else{
            $bomba_id = $user_bomba->first()->bomba_id;
            $bomba = Bomba::find($bomba_id);
            $tanque = Tanque::where('id', '=', $bomba->tanque_id)->first();
            $combustible = Combustible::find($tanque->combustible_id);
            $lista_vehiculos = Vehiculo::all();
            
            return view('modulo_ventas/nota_venta_combustible/create',['lista_vehiculos'=>$lista_vehiculos,'bomba'=>$bomba,'tanque'=>$tanque,'combustible'=>$combustible,'sin_bomba_asignada'=>false]);
        }
       

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


            $user = Auth::user();
            $user_bomba_id = UserBomba::where('user_id', '=', $user->id)->orderBy('fecha_asignacion', 'desc')->first()->id;
            $user_bomba = UserBomba::find($user_bomba_id);
            $tanque = $user_bomba->bomba->tanque;
            
            if($tanque->cantidad_disponible - $request->cantidad_combustible > 0){


                $nota_venta_combustible = new NotaVentaCombustible();
                $nota_venta_combustible->fecha =  $DateAndTime;
                $nota_venta_combustible->total = $request->cantidad_combustible * $request->precio;
                $nota_venta_combustible->cantidad_combustible = $request->cantidad_combustible;
                $nota_venta_combustible->vehiculo_id = $vehiculo_id;
                $nota_venta_combustible->user_bombas_id = $user_bomba_id;
                $nota_venta_combustible->save();

                $tanque->cantidad_disponible = $tanque->cantidad_disponible - $request->cantidad_combustible;
                $tanque->save();

                if ($nota_venta_combustible->total >= 100) {

                    $vehiculo = Vehiculo::find($vehiculo_id);
                    $cliente = Cliente::find($vehiculo->cliente_id);
                    $cliente->puntos =  $cliente->puntos + 1;
                    $cliente->save();


                }
                
                return redirect('nota_venta_combustible');

            }else{
                $vehiculo = Vehiculo::find($vehiculo_id);
                return redirect()->route('nota_venta_combustible.create')->with(['vehiculo_id' => $vehiculo->id.'`'.$vehiculo->b_sisa])->withErrors(['errors' => 'cantidad de combustible insuficiente!']);

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
        
        
        /* $bomba = Bomba::find($bomba_id);
        $tanque = Tanque::where('id', '=', $bomba->tanque_id)->first();
        $combustible = Combustible::find($tanque->combustible_id); */


        /* $nota_venta_combustible = NotaVentaCombustible::join('vehiculos', 'nota_venta_combustible.vehiculo_id', 'vehiculos.id')
        ->join('clientes','vehiculos.cliente_id','clientes.id')
        ->where('nota_venta_combustible.id','=',$id)
        ->select('nota_venta_combustible.*', 'vehiculos.placa','clientes.nombre')->first(); */
        
        $nota_venta_combustible = NotaVentaCombustible::find($id);
        $combustible =  $nota_venta_combustible->userBombas->bomba->tanque->combustible;
        return view('modulo_ventas.nota_venta_combustible.show', compact('nota_venta_combustible','combustible'));

       // return view('modulo_ventas.nota_venta_combustible.show', compact('nota_venta_combustible','bomba','tanque','combustible','user'));

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

    public function exportHTML()
    {
        return (new VentasCombustiblesExport)->download('reporte de ventas de combustibles.html', \Maatwebsite\Excel\Excel::HTML);
    }

    /**
     * Muestra las graficas de reportes
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function graficas()
    {
        return view('modulo_ventas.nota_venta_combustible.graficas');
    }

    /**
     * Retorna un json con el monto total de las ventas de productos realizadas por mes.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function ventasMes(Request $request)
    {
        $end_month = today();
        $pivot_month = today()->subMonths($request->rango - 1);

        $query_ventas_mes = DB::table('nota_venta_combustible')
            ->selectRaw("date_part('month',fecha) as mes, sum(total) as total")
            ->whereDate('fecha', '>=', $pivot_month->setDay(01))
            ->groupBy("mes")
            ->orderBy("mes")
            ->get();

        //verificacion de los 12 meses y correcion si algun mes falta
        $ventas_mes = array();
        $c = 0;

        while ($pivot_month->format('m') != $end_month->format('m')) {
            if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "total" => $query_ventas_mes[$c]->total]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "total" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "total" => $query_ventas_mes[$c]->total]);
        } else {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "total" => 0]);
            --$c;
        }
        return $ventas_mes;
    }

    public function montoPromedioVentaMes(Request $request)
    {
        $end_month = today();
        $pivot_month = today()->subMonths($request->rango - 1);

        $query_ventas_mes = DB::table('nota_venta_combustible')
            ->selectRaw("date_part('month',fecha) as mes, sum(total)/count(id) as monto_promedio")
            ->whereDate('fecha', '>=', $pivot_month->setDay(01))
            ->groupBy("mes")
            ->orderBy("mes")
            ->get();

        //verificacion de los 12 meses y correcion si algun mes falta
        $ventas_mes = array();
        $c = 0;

        while ($pivot_month->format('m') != $end_month->format('m')) {
            if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "monto_promedio" => $query_ventas_mes[$c]->monto_promedio]);
            } else {
                array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
                --$c;
            }
            ++$c;
            $pivot_month->addMonth(1);
        };

        if (array_key_exists($c, $query_ventas_mes->toArray()) && $query_ventas_mes[$c]->mes == $pivot_month->format('m')) {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($query_ventas_mes[$c]->mes), "monto_promedio" => $query_ventas_mes[$c]->monto_promedio]);
        } else {
            array_push($ventas_mes, ["mes" => $this->intToLiteralMonth($pivot_month->format('m')), "monto_promedio" => 0]);
            --$c;
        }

        return $ventas_mes;
    }
}
