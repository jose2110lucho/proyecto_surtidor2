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
use Illuminate\Http\Request;

class NotaCargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_nota_carga = NotaCarga::join('combustibles','nota_cargas.combustible_id','combustibles.id')
        ->select('nota_cargas.*','combustibles.nombre')->get();
        return view('pages/cargas/index',['lista_nota_carga'=>$lista_nota_carga]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $lista_combustibles = Combustible::all();//combustibles
        $lista_tanques = Tanque::all(); //productos
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
        
        

        foreach ($tanque_list as $tanque) {
            $detalle_carga = new DetalleCarga();
            $detalle_carga->cantidad=$tanque['cantidad'];
            $detalle_carga->precio_unitario = $tanque['precio'];
            $detalle_carga->nota_carga_id=$nota_carga->id;
            $detalle_carga->save();

            $refill = Tanque::find($tanque['tanque_codigo']);
            $refill->cantidad = $refill->cantidad + $tanque['cantidad'];
            $refill->estado = true;
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
        //
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
