<?php

namespace App\Http\Controllers;

use App\Models\Tanque;
use App\Http\Requests\StoreTanqueRequest;
use App\Http\Requests\UpdateTanqueRequest;
use App\Models\Combustible;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class TanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanques = Tanque::orderby('codigo', 'desc')->get();
       // $tanques = Tanque::orderby('id', 'asc')->get();
        //return response($tanques, 200);
        //return $tanques;
        return view('pages.tanques.index', compact('tanques'));
    }

    /***********API-Controller********************************/
    public function indexApi()
    {
        //$tanques = Tanque::orderby('codigo', 'desc')->get();
        $tanques = Tanque::orderby('id', 'asc')->get();
        return response($tanques, 200);
        //return $tanques;
        return view('pages.tanques.index', compact('tanques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combustibles= Combustible::all();
        return view('pages.tanques.create', compact('combustibles'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTanqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTanqueRequest $request)
    {
        $Tanque = Tanque::create($request->all());
        return redirect()->route('tanques.show', $Tanque);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function show(Tanque $tanque)
    {

        return view('pages.tanques.show', compact('tanque'));
    }

    /**
     * Recarga el tanque dada una cantidad espcificada.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recargar(Request $request, Tanque $tanque)
    {
        $aux=$tanque->capacidad - $tanque->cantidad_disponible;
        $validator = Validator::make($request->all(), [
        'cantidad_recarga' => 'required | lte:'.$aux,
        ], $messages = [
            'lte' => 'Se excedió la capacidad del tanque. La cantidad a recargar debe ser menor o igual a ' . $aux . ' lts',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tanques.show', $tanque)
                ->withErrors($validator)
                ->withInput();
        }

        $cantidad_actual = $tanque->cantidad_disponible + $request->cantidad_recarga;

        $tanque->update([
            'cantidad_disponible' => $cantidad_actual,
            'fecha_carga' => Carbon::now(),
        ]);
        return redirect()->route('tanques.show', compact('tanque'))->with('mensaje', 'Se cargaron '.$request->cantidad_recarga.' litros al tanque');
    }

    /**
     * Llena el tanque a su capacidad maxima
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function llenar(Tanque $tanque)
    {
        $tanque->update([
            'cantidad_disponible' => $tanque->capacidad,
            'fecha_carga' => Carbon::now(),
        ]);

        return redirect()->route('tanques.show', $tanque)->with('mensaje', 'Tanque cargado al máximo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanque $tanque)
    {
        $combustibles= Combustible::all();
        return view('pages.tanques.edit', compact('tanque','combustibles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTanqueRequest  $request
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTanqueRequest $request, Tanque $tanque)
    {
        $tanque->update($request->all());
        return redirect()->route('tanques.show', $tanque);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanque $tanque)
    {
        $tanque->delete();
        return redirect()->route('tanques.index');
    }
}
