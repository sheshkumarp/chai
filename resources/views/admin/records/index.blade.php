@extends('admin.layout.master')

@section('title')
{{ $moduleAction ?? 'Manage Admins' }}
@endsection

@section('styles')
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-xs-12 bundle width-auto-1-column-140">
            <div class="card border-0 shadow">
                <h1 class="title blue-border-bottom">
                    {{ strtoupper($moduleTitle) ?? 'MANAGE ADMIN' }}
                </h1>
                <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
                    @can('manage-admins')
                    <a href="#" class="blue-btn ml-auto" data-toggle="modal" data-target="#addAdmin" onclick="document.getElementById('adminForm').reset()" >Add Admin</a>
                    @endcan
                </div>
                <table id="adminListingTable" class="table last-border-none mb-0 even-odd-row no-border-right vertical-align-middle" style="width:100%" >
                    <thead>
                        <tr>
                            <th style="visibility: hidden;"></th>
                            <th class="w-140-px">First Name</th>
                            <th class="w-140-px">Last Name</th>
                            <th class="">Email</th>
                            <th class="text-center w-100-px">Role</th>
                            <th class="text-center w-100-px">Status</th>
                            <th class="text-center w-130-px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/records/index.js') }}"></script>
@endsection