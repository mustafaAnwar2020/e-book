<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:book-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:book-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $books= Book::paginate(5);
        return view('books.index')->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= category::listsTranslations('name')->get();
        $authors = Author::listsTranslations('name')->get();
        return view('books.create')->with('categories',$categories)->with('authors',$authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [];

        foreach(config('translatable.locales') as $locale)
        {
            $rules+=[$locale.'.name'=>['required',Rule::unique('book_translations','name')]];
            $rules+=[$locale.'.bio'=>'required'];
        }
        $rules +=[
            'price'=>'required',
            'stock'=>'required',
            'category_id'=>'required',
            'author_id'=>'required'
        ];
        $this->validate($request,$rules);

        $input = [
            "ar"=>[
                "name"=>$request->ar['name'],
                "bio"=>$request->ar['bio'],
            ],
            "en"=>[
                "name"=>$request->en['name'],
                "bio"=>$request->en['bio'],
            ],
            "price"=>$request->price,
            "stock"=>$request->stock,
            "category_id"=>$request->category_id,
            "img"=>''
        ];
        if ($request->img) {

            Image::make($request->img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/books/' . $request->img->hashName()));

            $input['img'] = $request->img->hashName();

        }

        $book = Book::create($input);

        $book->authors()->attach($request->author_id);
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show')->with("book",$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

        $categories= category::listsTranslations('name')->get();
        $authors = Author::listsTranslations('name')->get();
        return view('books.edit')->with('book',$book)->with('categories',$categories)->with('authors',$authors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $rules = [];

        foreach(config('translatable.locales') as $locale)
        {
            $rules+=[$locale.'.name'=>['required',Rule::unique('book_translations','name')->ignore($book->id,'book_id')]];
            $rules+=[$locale.'.bio'=>'required'];
        }
        $rules +=[
            'price'=>'required',
            'stock'=>'required',
            'category_id'=>'required',
            'author_id'=>'required'
        ];
        $this->validate($request,$rules);

        $input = [
            "ar"=>[
                "name"=>$request->ar['name'],
                "bio"=>$request->ar['bio'],
            ],
            "en"=>[
                "name"=>$request->en['name'],
                "bio"=>$request->en['bio'],
            ],
            "price"=>$request->price,
            "stock"=>$request->stock,
            "category_id"=>$request->category_id,
        ];

        if ($request->img) {
            if($request->img != 'book.png'){
                Storage::disk('public_uploads')->delete('/books/' . $book->img);
            }
            Image::make($request->img)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/books/' . $request->img->hashName()));

            $input['img'] = $request->img->hashName();

        }

        $book->update($input);
        $book->authors()->sync($request->author_id);
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete($book->id);
        return redirect()->route('book.index');
    }
}
