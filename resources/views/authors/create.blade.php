@extends('layouts.app')

@section('content')
    @include('partials.errors')
    <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header">@lang('site.add')</div>

            <div class="card-body">
                @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.name')</label>
                        <input class="form-control" type="text" name="{{ $locale }}[name]" id="title" required>
                        <span class="help-block"> </span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="title">@lang('site.' .$locale.'.description')</label>
                        <textarea class="form-control ckeditor" name="{{ $locale }}[bio]"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                        <span class="help-block"> </span>
                    </div>
                @endforeach

                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input type="file" name="img" class="form-control image">
                </div>


                <div class="form-group">
                    <img src="{{ asset('uploads/authors/writer.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                </div>
                <button class="btn btn-primary" type="submit">
                    @lang('site.save')
                </button>
            </div>
        </div>

    </form>
@endsection
