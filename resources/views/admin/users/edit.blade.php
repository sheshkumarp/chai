@extends('admin.layout.master')

@section('title')
{{ $moduleAction ?? '' }}
@endsection

@section('styles')
@endsection

@section('content')

@php
$isCurrent = auth()->user()->id === (int)base64_decode(base64_decode(request()->segment(3))) ?true:false;
@endphp

<div class="row mb-5">
    <div class="col-xs-12">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                {{ $moduleTitle ?? '' }}
            </h1>
            <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
                <a href="{{ route('admin.users.index') }}" class=" blue-btn-inverse cancel-btn">Cancel</a>
            </div>
            <h1 class="card-subtitle blue-border-bottom text-capitalize">
                {{ $moduleAction ?? '' }}
            </h1>
            <form id="userEditForm" action="{{route($modulePath.'.update',[base64_encode(base64_encode($user->id))])}}"
                data-toggle="validator" role="form">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" id="user_id" value="{{ base64_encode(base64_encode($user->id)) }}">

                <div class="card-body">

                    <div class="f-row">
                        <div class="f-col-6 p-0 d-flex">

                            <div class="mb-25 f-col-6 form-group">
                                <label class="theme-blue">@lang('admin.TITLE_FIRST_NAME') <span
                                        class="required">*</span></label>
                                <input class="form-control" type="text" name="first_name"
                                    value="{{ $user->first_name ?? '' }}" required
                                    data-error="@lang('admin.ERR_FIRST_NAME')">
                                <span class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li class="err_first_name"></li>
                                    </ul>
                                </span>
                            </div>

                            <div class="mb-25 f-col-6 form-group">
                                <label class="theme-blue">@lang('admin.TITLE_LAST_NAME') <span
                                        class="required">*</span></label>
                                <input class="form-control" type="text" name="last_name"
                                    value="{{ $user->last_name ?? '' }}" required
                                    data-error="@lang('admin.ERR_LAST_NAME')">
                                <span class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li class="err_last_name"></li>
                                    </ul>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="f-row">

                        <div class="mb-25 f-col-6 d-flex flex-column form-group">
                            <label class="theme-blue">@lang('admin.TITLE_EMAIL') <span class="required">*</span></label>
                            <input class="form-control" type="text" name="email" value="{{ $user->email ?? '' }}"
                                required data-error="@lang('admin.ERR_EMAIL_NAME')"
                                pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'
                                data-pattern-error="@lang('admin.ERR_EMAIL_FORMAT')">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_email"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="f-row ">

                        <div class="f-col-6 p-0 d-flex">
                            <div class="mb-25 f-col-6 form-group">
                                <label class="theme-blue">@lang('admin.TITLE_PASS') </label>
                                <input class="form-control" 
                                    type="password" 
                                    name="password" 
                                    id="password"
                                    placeholder="*********" 
                                    value="">
                                <span class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li class="err_password"></li>
                                    </ul>
                                </span>
                            </div>
                            <div class="mb-25 f-col-6">
                                <label class="theme-blue">@lang('admin.TITLE_CONFIRM_PASS') </label>
                                <input 
                                    class="form-control" 
                                    type="password" 
                                    name="confirm_password"
                                    placeholder="*********"
                                    value="">
                                <span class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li class="err_confirm_password"></li>
                                    </ul>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="d-flex">
                        <button type="submit" id="submitButton"
                            class="blue-btn ml-auto">@lang('admin.TITLE_SUBMIT_CHANGES_BUTTON')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('assets/admin/js/users/edit.js') }}"></script>
@endsection