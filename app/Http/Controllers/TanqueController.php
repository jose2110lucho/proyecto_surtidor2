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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTanqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTanqueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function show(Tanque $tanque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanque $tanque)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanque  $tanque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanque $tanque)
    {
        //
    }
}
