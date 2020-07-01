@extends('layouts.install')

@section('header', trans('install.steps.settings'))

@section('content')
    <div class="row">
        {{ Form::textGroup('company_name', trans('install.settings.company_name'), 'building', ['required' => 'required'], old('company_name'), 'col-md-12') }}

        {{ Form::textGroup('company_email', trans('install.settings.company_email'), 'envelope', ['required' => 'required'], old('company_email'), 'col-md-12') }}

        {{ Form::textGroup('user_email', trans('install.settings.admin_email'), 'envelope', ['required' => 'required'], old('user_email'), 'col-md-12') }}

        {{ Form::passwordGroup('user_password', trans('install.settings.admin_password'), 'key', ['required' => 'required'], 'col-md-12 mb--2') }}

        <input type="hidden" name="locale" value="en_GB">

        @if(\App\Models\Common\Company::pluck('id')->count() > 0)
        <input type="hidden" name="role" value="{{ \App\Models\Auth\Role::where('name', 'basic')->first()->id  }}">
        @else
        <input type="hidden" name="role" value="1">
        @endif
    </div>
@endsection
