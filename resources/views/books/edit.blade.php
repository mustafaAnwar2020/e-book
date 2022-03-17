@extends('layouts.app')

@section('content')
    @include('partials.errors')
    <form action="{{ route('book.update',$book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">@lang('site.edit')</div>

            <div class="card-body">
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.name')</label>
                        <input class="form-control" type="text" value="{{$book->translate()->name}}" name="{{ $locale }}[name]" id="title" required>
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.bookBio')</label>
                        <textarea class="form-control ckeditor" name="{{ $locale }}[bio]" id="exampleFormControlTextarea1"
                            rows="3">{{$book->translate()->bio}}</textarea>
                        <span class="help-block"> </span>
                    </div>
                @endforeach

                <div class="form-group">
                    <label class="required" for="price">@lang('site.price')</label>
                    <input class="form-control" type="text" value="{{$book->price}}" name="price" id="price" required>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="price">@lang('site.stock')</label>
                    <input class="form-control" type="text" value="{{$book->stock}}" name="stock" id="stock" >
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="form-label select-label">@lang('site.categories')</label><br>
                    <select id="example-single" name="category_id">
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <span class="help-block"> </span>
                </div>


                <div class="form-group">
                    <label class="form-label select-label">@lang('site.authors')</label><br>
                    <select id="example-multiple-selected" name="author_id[]"  multiple="multiple">
                        @foreach ($authors as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input type="file" name="img" class="form-control image">
                </div>


                <div class="form-group">
                    <img src="{{ asset('uploads/books/'.$book->img) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                </div>

                <button class="btn btn-primary" type="submit">
                    @lang('site.save')
                </button>
            </div>
        </div>

    </form>
@endsection
