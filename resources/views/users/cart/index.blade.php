@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap snippets bootdey">
        <div class="col-md-9 col-sm-8 content">
            <div class="row">
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('site.cart')</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-shadow">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.book')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.total')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->books as $book)
                                                <tr>
                                                    <td>{{ $book->translate()->name }}</td>
                                                    <td>
                                                        <form action="{{ route('cart.updateItem', $cart) }}" method="POST"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            <input class="item-right cart-quantity-input"
                                                                name="books[{{ $book->id }}][quantity]" type="number"
                                                                value="{{ $book->pivot->quantity }}">
                                                            <button
                                                                class="btn btn-sm btn-success">@lang('site.edit')</button>
                                                        </form>


                                                        <form action="{{ route('cart.delete', $book) }}" method="POST"
                                                            style="display: inline-block;">
                                                            @method('DELETE')
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button
                                                                class="btn btn-sm btn-warning">@lang('site.delete')</button>
                                                        </form>

                                                    </td>
                                                    <td>{{ $book->price }}</td>
                                                    <td>{{ $book->pivot->quantity * $book->price }}</td>

                                                </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @if (session('success'))
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ session('success') }}</strong>
                                    </span>
                                @endif
                                <div class="panel-heading" >
                                    <h3>
                                        @lang('site.total') : {{$cart->total_price}}
                                    </h3>
                                </div>


                                <a  href="{{route('orders.create',$cart)}}" class="btn btn-secondary btn-lg">@lang('site.add_order')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
