@include('admin.layout.partials.header')

@if(Auth::check())
<div class="main-section d-flex">
    <div class="left-sidebar shadow">
        @include('admin.layout.partials.sidebar')
    </div>
    <div class="rigth-sidebar">
        @endif

        @yield('content')

        @if(Auth::check())
    </div>
</div>
@endif

@include('admin.layout.partials.footer')