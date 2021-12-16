@extends('admin.layout.master')

@section('title')
{{ $moduleTitle }}
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-xs-12 bundle">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                {{ strtoupper($moduleAction) }}
            </h1>
            <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
            @can('manage-roles')
                <a onclick="return addRole(this)" data-href="{{ route('admin.roles.store') }}" class=" blue-btn ml-auto" data-toggle="modal" >Add Role</a><!-- {{ route($modulePath.'create') }} -->
            @endcan
            </div>
            <table class="table mb-0 first-child-border-0 even-odd-row-1" id="listingTable" class="display">
                <thead class="">
                    <tr>
                        <th class="">Name</th>
                        <th class="w-130-px">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
    @section('model')
        @include('admin.roles.create-role-model')
    @show 
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/admin/js/roles/index.js') }}"></script>
@stop