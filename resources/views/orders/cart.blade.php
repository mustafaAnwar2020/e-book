@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap snippets bootdey">
        <div class="col-md-9 col-sm-8 content">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info panel-shadow">
                        <div class="panel-heading">
                            <h3>
                                @lang('site.cart')
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->books as $item)
                                            <tr>
                                                <td>{{ $item->translate()->name }}</td>
                                                <td>

                                                    <form class="form-inline"
                                                        action="{{ route('orders.update', ['user' => Auth::user(), 'order' => $order]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class="item-right cart-quantity-input"
                                                            name="books[{{ $item->id }}][quantity]" type="number"
                                                            value="{{ $item->pivot->quantity }}">
                                                        <button rel="tooltip" class="btn btn-default"><i
                                                                class="fa fa-pencil"></i></button>


                                                        <form action="{{ route('order.destroy', $item) }}" method="POST"
                                                            style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button
                                                                class="btn btn-sm btn-danger">@lang('site.delete')</button>
                                                        </form>
                                                    </form>

                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->price * $item->pivot->quantity }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Continue
                        Shopping</a>
                    <a href="#" class="btn btn-primary pull-right">Next<span
                            class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection
