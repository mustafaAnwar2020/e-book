<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();
        return view('authors.index')->with('authors',$authors);
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

    public function store(Request $request)
    {
        $rules = [];


        foreach(config('translatable.locales') as $locale)
        {
            $rules+=[$locale.'.bio'=>'required'];
            $rules+=[$locale.'.name'=>['required',Rule::unique('author_translations','name')]];
        }

        $this->validate($request,$rules);

        $input = $request->all();


        if ($request->img) {

            Image::make($request->img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/authors/' . $request->img->hashName()));

            $input['img'] = $request->img->hashName();

        }

        $author = Author::create($input);
        return redirect()->route('author.index');
    }


    public function show(Author $author)
    {
        return view('authors.show')->with('author',$author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit')->with('author',$author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $rules = [];


        foreach(config('translatable.locales') as $locale)
        {
            $rules+=[$locale.'.bio'=>'required'];
            $rules+=[$locale.'.name'=>['required',Rule::unique('author_translations','name')->ignore($author->id,'author_id')]];
        }

        $this->validate($request,$rules);

        $input = $request->all();
        if ($request->img) {
            if($request->img != 'default.png'){
                Storage::disk('public_uploads')->delete('/authors/' . $author->img);
            }
            Image::make($request->img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/authors/' . $request->img->hashName()));

            $input['img'] = $request->img->hashName();

        }


        $author->update($input);
        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete($author->id);
        return redirect()->route('author.index');
    }
}
