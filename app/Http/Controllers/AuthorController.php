<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo_path')) {
            $profile_photo_path = $request->file('profile_photo_path')->store('authors_photo');
            $data['profile_photo_path'] = $profile_photo_path;
        };

        $data['alias'] ??= auth()->user()->name;

        $data['user_id'] = auth()->user()->id;

        Author::create($data);

        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return redirect()->route('authors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAuthorRequest $request, Author $author)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo_path')) {
            $profile_photo_path = $request->file('profile_photo_path')->store('authors_photo');
            $data['profile_photo_path'] = $profile_photo_path;

            Storage::delete($author->profile_photo_path);
        };

        $author->update($data);

        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        // if (!$author->works->first()) {
        //     if ($author->profile_photo_path)
        //     {
        //         Storage::delete($author->profile_photo_path);
        //     }
        //     $author->delete();
        // }
        $author->delete();
        //MENSAJE PARA QUE BORRE TODAS LAS OBRAS
        return redirect()->route('authors.index');
    }
}
