@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">@lang('site.contact_info')</div>

    <div class="card-body">
        <form action="{{ route('profile.update',$profile) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="first_name">@lang('site.name')</label>
                <input class="form-control" type="text" name="name" id="name" value="{{$profile->user->name}}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="address">@lang('site.address')</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ $profile->address }}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">@lang('site.phone')</label>
                <input class="form-control" type="text" name="phone" id="phone_number" value="{{ $profile->phone }}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="phone_number">@lang('site.contact')</label>
                <input class="form-control" type="text" name="contact" id="phone_number" value="{{ $profile->contact }}" required>
                <span class="help-block"> </span>
            </div>

            <button class="btn btn-primary" type="submit">
                @lang('site.save')
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">@lang('site.change_password')</div>

    <div class="card-body">
        <form action="{{route('profile.password',$profile)}}" method="POST">
            @csrf

            <div class="form-group">
                <label class="required" for="old_password">@lang('site.old_password')</label>
                <input class="form-control" type="password" name="oldPassword" id="old_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password">@lang('site.new_passowrd')</label>
                <input class="form-control" type="password" name="newPassword" id="new_password" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="new_password_confirmation">@lang('site.confirm')</label>
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
