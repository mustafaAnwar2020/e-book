@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">@lang('site.add')</div>

    <div class="card-body">
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            @include('partials.errors')
            <div class="form-group">
                <label class="required" for="first_name">@lang('site.name')</label>
                <input class="form-control" type="text" name="name"  id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="first_name">@lang('site.email')</label>
                <input class="form-control" type="email" name="email"  id="name" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="address">@lang('site.address')</label>
                <input class="form-control" type="text" name="address"  id="address"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">@lang('site.phone')</label>
                <input class="form-control" type="text" name="phone" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">@lang('site.contact')</label>
                <input class="form-control" type="text" name="contact" id="phone_number"  required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label for="client_id">Role</label>
                <select class="form-control" name="role" id="project_id" required>
                    @foreach ($role as $item)
                        <option value="{{ $item->id }}" {{ $item->id == 'id' ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password">Password</label>
                <input class="form-control" type="password" name="password" id="new_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password_confirmation">Confirm Password</label>
                <input class="form-control " type="password" name="confirmPassword" id="new_password_confirmation" required>
                <span class="help-block"> </span>
            </div>

            <button class="btn btn-primary" type="submit">
                @lang('site.save')
            </button>
        </form>
    </div>
</div>

@endsection
