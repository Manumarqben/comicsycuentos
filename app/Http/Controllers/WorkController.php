<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Age;
use App\Models\Author;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $works = Work::all();
        return view('works.index', ['works' => $works]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $ages = Age::all();
        $states = State::all();

        return view('works.create', compact('types', 'ages', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        $data = $request->validated();

        $front_path = $request->file('front_page')->store('fronts');
        $data['front_page'] = $front_path;

        $usuario = auth()->user()->id;
        $autor = Author::where('user_id', $usuario)->first()->id;
        $data['author_id'] = $autor;

        Work::create($data);

        return redirect()->route('works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        return redirect()->route('works.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $types = Type::all();
        $ages = Age::all();
        $states = State::all();

        return view('works.edit', compact('work', 'types', 'ages', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $data = $request->validated();

        if ($request->hasFile('front_path')) {
            $front_path = $request->file('front_page')->store('fronts');
            $data['front_page'] = $front_path;

            Storage::delete($work->$front_path);
        }

        $work->update($data);

        return redirect()->route('works.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->route('works.index');
    }
}
