<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Premio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::orderby('nombre', 'desc')
            ->where('nombre', 'ilike', '%' . $request->buscar . '%')
            ->orwhere('apellido', 'ilike', '%' . $request->buscar . '%')
            ->paginate(9);
        return view('pages.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return redirect()->route('clientes.show', $cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('pages.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('pages.clientes.edit', compact('cliente'));
    }

    /**
     * Muestra el formulario para canjear los puntos acumulados del cliente por premios.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function canjeo(Cliente $cliente)
    {
        $premios = Premio::all();
        return view('pages.clientes.canjear', compact('cliente', 'premios'));
    }

    /**
     * Almacena el nuevo registro de la tabla cliente_premio.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function canjear(Cliente $cliente, Request $request)
    {
        $premio = Premio::find($request->premio_id);

        $validator = Validator::make($request->all(), [
            'premio_id' => 'required',
        ], $messages = [
            'premio_id.required' => 'Seleccione el premio para canjear',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($premio->puntos_requeridos <= $cliente->puntos) {
            $cliente->premios()->attach($request->premio_id);
            $sobrante = $cliente->puntos - $premio->puntos_requeridos;

            $cliente->update(['puntos' => $sobrante]);
            return redirect()->route('clientes.show', compact('cliente'));
        } else {
            $errors = new MessageBag();
            $errors->add('premio_id', 'Puntos insuficientes!');
            return redirect()->back()->withErrors($errors);
        }

        
    }

    /**
     * Almacena el nuevo registro de la tabla cliente_premio.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroyPremio(Cliente $cliente, $cliente_premio_id)
    {
        $cliente->premios()->wherePivot('id', '=', $cliente_premio_id)->detach();
        return redirect()->route('clientes.show', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
        return redirect()->route('clientes.show', [$cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
