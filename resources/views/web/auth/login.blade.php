@extends('web.layout.master')

@section('title')
    {{ $moduleTitle ?? 'User Login' }}
@endsection

@section('styles')

@endsection

@section('content')
    <div class="d-flex pb-5">
    <div class="login-wrapper">
        <div class="card border-0 shadow">

            <h1 class="title blue-border-bottom">
                {{ $moduleAction }}
            </h1>

            <form id='loginForm' action="{{ route($modulePath) }}" data-toggle="validator">
                {{ csrf_field() }}
                <div class="card-body d-flex flex-column">

                    <div class="form-group">
                        <label for="usr" class="theme-blue bold">Email</label>
                        <input type="text" 
                            class="form-control" 
                            name="username" 
                            value="{{ $user->username ?? '' }}"
                            required
                            data-error="Email field is required" 
                        >
                        <span class="help-block  with-errors">
                            <ul class="list-unstyled">
                                <li class="err_username" ></li>
                            </ul>
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="pwd" class="theme-blue bold">@lang('admin.TITLE_PASSWORD')</label>
                        <input type="password" 
                            class="form-control"
                            name="password" 
                            value="{{ $user->password ?? '' }}"
                            required
                            data-error="@lang('admin.ERR_PASSWORD_REQUIRED')" 
                        >
                        <span class="help-block  with-errors">
                            <ul class="list-unstyled">
                                <li class="err_password"></li>
                            </ul>
                        </span>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <label class="checkbox-container theme-blue">
                            <input type="checkbox"
                                class="form-control" 
                                name="remember" 
                                @if(!empty($user))
                                    checked
                                @endif 
                            >
                        </label>
                    </div>

                    <div class="form-group text-center mt-3">
                        <button type="submit" id="btnLogin" value="Login" class="blue-btn">@lang('admin.BUTTON_LOGIN')</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/web/js/auth/login.js') }}"></script>
@endsection