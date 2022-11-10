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
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function show(SocialNetwork $socialNetwork)
    {
        return redirect()->route('networks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialNetwork $socialNetwork)
    {
        return view('networks.edit', compact('socialNetwork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSocialNetworkRequest $request, SocialNetwork $socialNetwork)
    {
        $data = $request->validated();

        $socialNetwork->update($data);

        return redirect()->route('networks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialNetwork  $socialNetwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();

        return redirect()->route('networks.index');
    }
}
