@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('users.create')}}">
                @lang('site.add')
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">@lang('site.users')</div>

        <div class="card-body">

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.phone')</th>
                        <th>role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <?php try{?>

                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->profile->phone}}</td>
                            <td>@foreach ($item->getRoleNames() as $role){{$role}}@endforeach</td>


                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('users.edit',$item)}}">
                            @lang('site.edit')
                        </a>

                        <form action="{{route('users.destroy',$item)}}" method="POST"
                            onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-sm btn-danger" value="@lang('site.delete')">
                        </form>
                    </td>
                    <?php } catch(\Exception $e){?>
                        <p>User has no role yet</p>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{route('users.edit',$item)}}">
                                @lang('site.edit')
                            </a>

                            <form action="{{route('users.destroy',$item)}}" method="POST"
                                onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-danger" value="@lang('site.delete')">
                            </form>
                        </td>
                    </tr>
                        <?php }?>
                </tr>

                    @endforeach
                </tbody>
            </table>

            {{-- {{ $users->withQueryString()->links() }} --}}
        </div>
    </div>

@endsection
