@extends('layouts.app')

@section('content')
    <div class="container" style="text-align:center">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card" >
                        <img src="{{ asset('uploads/authors/'.$author->img) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-text">{!! $author->translate()->name !!}</h5>
                            <p class="card-text">{!! $author->translate()->bio !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
