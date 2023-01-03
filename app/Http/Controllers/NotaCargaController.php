<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use App\Models\Tanque;
use App\Models\DetalleCarga;
use App\Models\NotaCarga;
use App\Models\Combustible;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotaCargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
            if ($request->ajax()) {
                $combustible_id = $request->combustible_id;
                $combustible_nombre = $request->combustible_nombre;
                $fecha_inicio = $request->fecha_inicio;
                $fecha_fin = $request->fecha_fin;
                $combustible_tipo = $request->combustible_tipo;
                $combustibles = DB::select('select * from listaCombustibles(?,?,?,?,?)', [$combustible_id, $combustible_nombre,$fecha_inicio, $fecha_fin, $combustible_tipo]);
                return DataTables::of($combustibles)->make(true);
            }
            $lista_combustibles = Combustible::all();
            $lista_nota_carga = NotaCarga::join('combustibles','nota_cargas.combustible_nombre','combustibles.id')
            ->select('nota_cargas.*','combustibles.nombre')->get();
            return view('pages/cargas/index',['lista_nota_carga'=>$lista_nota_carga]); 
        } 
        /* $tipo=$request->get ('buscarpor');  
        $combustibles = Combustible::where('nombre','like',"%nombre%"); */
       /*  $lista_combustibles = Combustible::all(); */
      /*   $lista_nota_carga = NotaCarga::join('combustibles','nota_cargas.combustible_nombre','combustibles.id')
        ->select('nota_cargas.*','combustibles.nombre')->get(); */
       /*  return view('pages/cargas/index',['lista_nota_carga'=>$lista_nota_carga],compact('combustibles')); 
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $lista_combustibles = Combustible::all();//combustibles
        $lista_tanques = Tanque::all(); //productos
      /*  $combustible = Combustible::/* join('combustibles','combustibles.precio_compra','combustibles.id')
                                           ->where('combustibles.id','=', $id)
                                           ->select('combustibles.*','combustibles.precio_compra')->first();  */
                                           /* when(request()->input('lista_combustibles_id'),function($query){
                                            $query->where('lista_combustibles_id',request()->input('lista_combustibles_id'));
                                           })->pluck('id','precio_compra'); */
        return view('/pages/cargas/create',['lista_combustibles'=>$lista_combustibles,'lista_tanques'=>$lista_tanques]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $combustible_nombre = $request->combustible_nombre;
        $tanque_list = $request->tanque_list;
        $total = $request->total;
        $fecha_hora = new DateTime();  
        $fecha_hora->setTimezone(new DateTimeZone('America/La_Paz'));
        $DateAndTime = $fecha_hora->format("Y-m-d H:i:s"); 
        

        $nota_carga =  new NotaCarga();
        $nota_carga->combustible_nombre=$combustible_nombre;
        $nota_carga->fecha=$DateAndTime;
        $nota_carga->total=$total;
        $nota_carga->save();
        
        //return $nota_carga->id;

        foreach ($tanque_list as $tanque) {
            
            $refill = Tanque::where('codigo',$tanque['tanque_codigo'])->first();
            //return $refill->id;
            $detalle_carga = new DetalleCarga();
            $detalle_carga->cantidad=$tanque['cantidad_tanque'];
            $detalle_carga->precio_unitario = $tanque['precio'];
            $detalle_carga->nota_cargas_id=$nota_carga->id;
            $detalle_carga->tanque_codigo=$refill->id;
           //return $detalle_carga;
            $detalle_carga->save();
            
            
            $refill->cantidad_disponible = $refill->cantidad_disponible + $tanque['cantidad_tanque'];
            //$refill->estado = true;
            $refill->save();
        }

        
        return $nota_carga->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota_carga = NotaCarga::join('combustibles','nota_cargas.combustible_nombre','combustibles.id')
                                           ->where('nota_cargas.id','=', $id)
                                           ->select('nota_cargas.*','combustibles.nombre')->first();
                                           
        $lista_tanques = DetalleCarga::join('tanques','detalle_cargas.tanque_codigo','tanques.id')
                                            ->where('detalle_cargas.nota_cargas_id','=',$id)
                                            ->select('detalle_cargas.*','tanques.codigo')->get();                                   
                                         
        return view('pages.cargas.show',compact('nota_carga','lista_tanques'));
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
