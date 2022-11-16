<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCargaRequest;
use App\Http\Requests\UpdateCargaRequest;
use App\Models\Tanque;
use App\Models\Carga;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Support\Facades\Validator;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargas = Carga::orderby('codigo', 'desc')->get();
        return view('pages.cargas.index',compact('cargas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargas= new Carga();
        $tanques=Tanque::pluck('codigo','id');
        return view('pages.cargas.create',compact('cargas','tanques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargaRequest $request, Carga $carga)
    {
        $codTanque= $request->cod_tanque;
        $sql = "SELECT * FROM tanques where codigo='".$codTanque."'";
        $tanque = DB::select($sql);


        $cargaDisponible=0;
        foreach($tanque as $item){
            if($item->cantidad_disponible){
                $cargaDisponible=$item->cantidad_disponible;
            }
}
        foreach($tanque as $tan){
            if($tan->capacidad >=($request->cantidad+$cargaDisponible)){
    
            $Carga = Carga::create([
            'codigo'=>$request->codigo,
            'fecha'=>$request->fecha,
            'cantidad'=>$request->cantidad,
            'precio_unitario'=>$request->precio_unitario,
            'precio_total'=>$request->precio_total,
     ]);
        //--TRIGGER->PROCEDIMIENTO ALMACENADO
        $cantidadRenovada=$cargaDisponible+=$request->cantidad;
        $sql = "UPDATE tanques  SET cantidad_disponible='".$cantidadRenovada."' where codigo='".$codTanque."' ";
        DB::select($sql);
        return redirect()->route('cargas.show', $Carga);
  }
}
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Carga $carga)
    {
        return view('pages.cargas.show', compact('carga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Carga $carga)
    {
        return view('pages.cargas.edit', compact('carga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCargaRequest $request, Carga $carga)
    {
       
        $carga->update($request->all());
        return redirect()->route('cargas.show', $carga);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carga $carga)
    {
        $carga->delete();
        return redirect()->route('cargas.index');
    }
}