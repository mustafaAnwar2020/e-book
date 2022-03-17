@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('category.create')}}">
                Create Category
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">@lang('site.categories')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <form action="#" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{request()->search}}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                        </div>
                    </div>
                </form>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $i++}}</a></td>
                            <td>{{ $cat->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('category.edit',$cat)}}">
                                    @lang('site.edit')
                                </a>
                                <form action="{{route('category.destroy',$cat)}}" method="POST"
                                    onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger" value="@lang('site.delete')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $tasks->withQueryString()->links() }} --}}
        </div>
    </div>
@endsection
