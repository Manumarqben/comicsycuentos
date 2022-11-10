<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgeRequest;
use App\Models\Age;
use Illuminate\Http\Request;

class AgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ages = Age::all();
        return view('ages.index', ['ages' => $ages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgeRequest $request)
    {
        $data = $request->validated();

        Age::create($data);

        return redirect()->route('ages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Age  $age
     * @return \Illuminate\Http\Response
     */
    public function show(Age $age)
    {
        return redirect()->route('ages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Age  $age
     * @return \Illuminate\Http\Response
     */
    public function edit(Age $age)
    {        
        return view('ages.edit', compact('age'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Age  $age
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAgeRequest $request, Age $age)
    {
        $data = $request->validated();

        $age->update($data);
        
        return redirect()->route('ages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Age  $age
     * @return \Illuminate\Http\Response
     */
    public function destroy(Age $age)
    {
        $age->delete();
        return redirect()->route('ages.index');
    }
}
