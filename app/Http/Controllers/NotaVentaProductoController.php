<?php

namespace App\Http\Controllers;

use App\Exports\VentasProductosExport;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\NotaVentaProducto;
use App\Models\DetalleNotaVentaProducto;
use App\Models\FacturaProducto;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Decimal;
use Yajra\DataTables\Facades\DataTables;

class NotaVentaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $vehiculos = DB::table('nota_venta_producto')
                ->join('clientes', 'nota_venta_producto.cliente_id', '=', 'clientes.id')
                ->select(['nota_venta_producto.*', 'clientes.nombre as cliente']);

            return DataTables::of($vehiculos)
                ->addColumn('actions', 'partials.ventas_productos.actions')
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

        $lista_nota_venta_producto = NotaVentaProducto::join('clientes', 'nota_venta_producto.cliente_id', 'clientes.id')
            ->select('nota_venta_producto.*', 'clientes.nombre')->get();
        return view('modulo_ventas/nota_venta_producto/reportes', ['lista_nota_venta_producto' => $lista_nota_venta_producto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_productos = Producto::where('estado', '=', true)->select('*')->get();
        $lista_clientes =  Cliente::where('estado', '=', true)->select('*')->get();
        return view('modulo_ventas/nota_venta_producto/create', ['lista_productos' => $lista_productos, 'lista_clientes' => $lista_clientes]);
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
        $nota_venta_producto->fecha = $DateAndTime;
        $nota_venta_producto->total = $total;
        $nota_venta_producto->save();



        foreach ($producto_list as $producto) {
            $refill = Producto::find($producto['producto_id']);
            if ($producto['cantidad'] <= $refill->cantidad) {
                $detalle_producto = new DetalleNotaVentaProducto();
                $detalle_producto->cantidad = $producto['cantidad'];
                $detalle_producto->nota_venta_producto_id = $nota_venta_producto->id;
                $detalle_producto->producto_id = $producto['producto_id'];
                $detalle_producto->save();

                $refill->cantidad = $refill->cantidad - $producto['cantidad'];
                if ($refill->cantidad < 1) {
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
            ->select('detalle_nota_venta_producto.*', 'producto.nombre', 'producto.precio_venta')->get();


        $listaFacturaProducto = FacturaProducto::where('nota_venta_producto_id', '=', $id)->select('*')->get();

        $existeFactura = count($listaFacturaProducto) > 0 ? true : false;

        return view('modulo_ventas.nota_venta_producto.show', compact('nota_venta_producto', 'lista_productos', 'existeFactura'));
    }

    /**
     * Muestra las graficas de reportes
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function graficas()
    {
        return view('modulo_ventas.nota_venta_producto.graficas');
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

    public function exportHTML()
    {
        return (new VentasProductosExport)->download('reportede ventas.html', \Maatwebsite\Excel\Excel::HTML);
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
        $pivot_month = $this->calcularMesPivote($request->rango);

        $query_ventas_mes = DB::table('nota_venta_producto')
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
        $pivot_month = $this->calcularMesPivote($request->rango);

        $query_ventas_mes = DB::table('nota_venta_producto')
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

    public function intToLiteralMonth($month_number)
    {
        switch ($month_number) {
            case '1':
                return 'enero';
                break;
            case '2':
                return 'febrero';
                break;
            case '3':
                return 'marzo';
                break;
            case '4':
                return 'abril';
                break;
            case '5':
                return 'mayo';
                break;
            case '6':
                return 'junio';
                break;
            case '7':
                return 'julio';
                break;
            case '8':
                return 'agosto';
                break;
            case '9':
                return 'septiembre';
                break;
            case '10':
                return 'octubre';
                break;
            case '11':
                return 'noviembre';
                break;
            case '12':
                return 'diciembre';
                break;
            default:
                break;
        }
    }

    public function calcularMesPivote($rango)
    {
        $nro_meses_restar = 11;
        switch ($rango) {
            case '3':
                $nro_meses_restar = 2;
                break;
            case '6':
                $nro_meses_restar = 5;
                break;
            case '12':
                $nro_meses_restar = 11;
                break;
            default:
                break;
        };
        return today()->subMonths($nro_meses_restar);
    }
}
