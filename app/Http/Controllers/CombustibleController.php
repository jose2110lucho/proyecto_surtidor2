<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Http\Requests\StoreCombustibleRequest;
use App\Http\Requests\UpdateCombustibleRequest;

class CombustibleController extends Controller
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
     * @param  \App\Http\Requests\StoreCombustibleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCombustibleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combustible  $combustible
     * @return \Illuminate\Http\Response
     */
    public function show(Combustible $combustible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Combustible  $combustible
     * @return \Illuminate\Http\Response
     */
    public function edit(Combustible $combustible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCombustibleRequest  $request
     * @param  \App\Models\Combustible  $combustible
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCombustibleRequest $request, Combustible $combustible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Combustible  $combustible
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combustible $combustible)
    {
        //
    }
}
