<?php

namespace App\Http\Controllers;

use App\Models\Tanque;
use App\Http\Requests\StoreTanqueRequest;
use App\Http\Requests\UpdateTanqueRequest;

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
        return view('pages.tanques.index', compact('tanques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tanques.create');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanque $tanque)
    {
        return view('pages.tanques.edit', compact('tanque'));
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
