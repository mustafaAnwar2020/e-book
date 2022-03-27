@extends('layouts.books.home')

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">@lang('site.profile')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('site.favourites')</li>
            </ol>
        </nav>
    </div>
    <section class="container content-section">
        <h2 class="section-header">@lang('site.favourites')</h2>

        <div class="shop-items">
            @foreach ($user->favouriteBooks as $book)
                <div>
                    <div class="shop-item">
                        <span class="shop-item-title"><a class="" style="text-decoration: none"
                                href="{{ route('book.show', $book) }}">{{ $book->translate()->name }}</a></span>
                        <img class="shop-item-image" src="{{ asset('uploads/books/' . $book->img) }}">
                        <div class="shop-item-details">
                            <span class="shop-item-price">${{ $book->price }}</span>
                            <form action="{{ route('user.deleteFavourite', $book) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-warning"><i class="fa-solid fa-xmark"></i></button>
                            </form>

                        </div>
                        <div class="shop-item-details">
                            <span class="">
                                @foreach ($book->authors as $author)
                                    <a class="" style="text-decoration: none"
                                        href="{{ route('author.show', $author->id) }}">{{ $author->translate()->name }}</a>
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
