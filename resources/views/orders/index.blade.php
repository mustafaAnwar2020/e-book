@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">@lang('site.categories')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.orderDate')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $i++}}</a></td>
                            <td>{{$item->created_at->diffForhumans()}}</td>
                            <td>
                                <form action="{{route('order.destroy',$item)}}" method="POST"
                                    onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-warning" value="@lang('site.delete')">
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
