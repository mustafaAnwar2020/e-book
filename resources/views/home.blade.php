@extends('layouts.books.home')

@section('content')
    <section class="container content-section">
        <h2 class="section-header">E-book</h2>


        <form action="{{ route('home.index') }}" method="get">
            <div class="container h-100">
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                        <input class="search_input" type="text" name="search" value="{{ request()->search }}"
                            placeholder="@lang('site.search')">
                        <button type="submit" class="search_icon btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="shop-items">
            @foreach ($books as $item)
                <div>
                    <div class="shop-item">
                        <span class="shop-item-title"><a class="" style="text-decoration: none"
                                href="{{ route('book.show', $item) }}">{{ $item->translate()->name }}</a></span>
                        <img class="shop-item-image" src="{{ asset('uploads/books/' . $item->img) }}">
                        <div class="shop-item-details">
                            <span class="shop-item-price">${{ $item->price }}</span>
                            <input type="hidden" value="{{ $item->id }}" class="book-id">
                            <button class="btn btn-success shop-item-button" type="button"><i
                                    class="fa-solid fa-cart-shopping"></i></button>
                            <form action="{{route('user.addFavourite',$item)}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-warning"><i class="fa fa-star"></i></button>
                            </form>

                        </div>
                        <div class="shop-item-details">
                            <span class="">
                                @foreach ($item->authors as $author)
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
