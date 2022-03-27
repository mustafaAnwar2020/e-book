@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('role.create') }}">
                @lang('site.add')
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">@lang('site.roles')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)


                        <tr>
                            <td><a href="{{ route('role.show', $item) }}">{{ $item->name }}</a></td>

                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('role.edit', $item) }}">
                                    @lang('site.edit')
                                </a>

                                <form action="{{ route('role.destroy', $item) }}" method="POST"
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

            {{-- {{ $roles->withQueryString()->links() }} --}}
        </div>
    </div>

@endsection
