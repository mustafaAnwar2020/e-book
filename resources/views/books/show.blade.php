@extends('layouts.books.app')

@section('content')
    <div class="p-4 shadow bg-white rounded-lg">

        <div class="flex flex-col flex-shrink-0 items-center lg:items-stretch">
            <aside class="lg:col-span-6 xl:col-span-4">
                <picture class="relative overflow-hidden rounded-lg lg:pb-2/1" itemscope
                    itemtype="https://schema.org/ImageObject">
                    <img src="{{ asset('uploads/books/' . $book->img) }}"
                        class=" hover:opacity-90 transition-all duration-1000 hover:scale-105 object-cover rounded-lg ring-1 ring-black ring-opacity-5 "
                        alt="">
                </picture>
            </aside>
        </div>
        <div class="mt-6">
            <article class="lg:col-span-11 xl:col-span-15">
                <div class="mb-3">
                    <header class="mb-8">
                        <h1 class="flex justify-between items-center mb-12 text-2xl font-extrabold secondary-font-bold text-blueGray-700"
                            itemprop="name">
                            {{ $book->translate()->name }}
                        </h1>
                    </header>
                </div>

                <dl class="my-8 single-book__metadata" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <link itemprop="availability" href="https://schema.org/InStock">
                    <div class="flex items-center">
                        <dt class="text-xs font-extrabold w-18 text-blueGray-600">@lang('site.price')</dt>
                        <dd class="text-2xl font-extrabold leading-none text-blueGray-700 secondary-font-bold">
                            <span itemprop="price">{{ $book->price }}</span>
                            <meta itemprop="priceCurrency" content="ج.م">
                        </dd>
                    </div>
                </dl>

                <button class="btn btn-success shop-item-button" type="button" >
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </article>

            <article class="lg:col-span-11 xl:col-span-15">
                <div
                    class="inline-flex items-center pb-2 my-4 text-lg border-b-4 border-pink-500 text-blueGray-600 secondary-font-bold font-extrabold">
                    <span class="text-transparent bg-clip-text bg-gradient-to-l from-blueGray-700 to-blueGray-500">
                        @lang('site.BookDesc')
                    </span>
                </div>
                {{$book->category->translate()->name}}
                <div class="description text-gray-600 mb-6 leading-10 rtl" itemprop="description">
                    <div class="open:bg-white open:ring-1 open:ring-black/5 open:shadow-lg p-6 rounded-lg">
                        <p class="text-sm leading-8 text-gray-900 font-semibold select-none">
                           {{$book->translate()->bio}}
                        </p>
                    </div>
                </div>
            </article>



        </div>

    </div>
@endsection
