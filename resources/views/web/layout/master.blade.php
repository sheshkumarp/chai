@include('web.layout.partials.header')

@if(Auth::check())
<div class="main-section d-flex">
    <div class="left-sidebar shadow">
        @include('web.layout.partials.sidebar')
    </div>
    <div class="rigth-sidebar">
        @endif

        @yield('content')

        @if(Auth::check())
    </div>
</div>
@endif

@include('web.layout.partials.footer')