<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSocialNetworkRequest;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $networks = SocialNetwork::all();
        return view('networks.index', ['networks' => $networks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('networks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialNetworkRequest $request)
    {
        $data = $request->validated();

        SocialNetwork::create($data);

        return redirect()->route('networks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialNetwork  $network
     * @return \Illuminate\Http\Response
     */
    public function show(SocialNetwork $network)
    {
        return redirect()->route('networks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialNetwork  $network
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialNetwork $network)
    {
        return view('networks.edit', compact('network'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSocialNetworkRequest $request, SocialNetwork $network)
    {
        $data = $request->validated();

        $network->update($data);

        return redirect()->route('networks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialNetwork $network)
    {
        $network->delete();

        return redirect()->route('networks.index');
    }
}
