@extends('admin.layout.master')

@section('title')
{{ $moduleAction ?? 'Manage Permissions' }}
@endsection

@section('styles')
@endsection

@section('content')

    <div class="row mb-5">
        <div class="col-xs-12">
            <form action="{{ route('admin.permissions.store') }}" id="permissionsForm" data-toggle="validator" >
                <div class="card border-0 shadow">
                    <h1 class="title blue-border-bottom">
                        Manage Permissions
                    </h1>
                    <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
                        <!-- <a href="#addRole" class=" blue-btn ml-auto" data-toggle="modal" >Add Role</a> -->
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="d-flex flex-column w-25 form-group mb-0">
                            <label class="theme-blue">Select Role</label>
                            <select class="form-control my-select" name="role" placeholder="All State" onchange="return getPermissions(this)" required data-error="Role field is required." >
                                <option value="">Select Role</option>
                                @if(!empty($roles) && sizeof($roles) > 0)
                                    @foreach($roles as $key => $role)
                                        <option value="{{ base64_encode(base64_encode($role->id)) }}">{{ ucfirst(str_replace('-', ' ', $role->name) ?? '--') }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="help-block with-errors">
                              <ul class="list-unstyled">
                                 <li class="err_role"></li>
                              </ul>
                           </span>

                        </div>
                       <!--  <a href="#" class="red ml-3 text-underline bold">Delete</a> -->
                    </div>
                    <div class="panel-group toggle-group" id="accordion1">
                        <!-- third -->
                        @section('permissions')
                            @include('admin.permissions.role-permissions')
                        @show

                    </div>
                    @can('manage-permissions')
                    <div class="card-body pt-0 d-flex">
                        <button class=" blue-btn ml-auto" id="submitButton" type="submit">Save Changes</button>
                    </div>
                    @endcan
                </div>
            </form>
        </div>
    </div>

    @section('model')
        @include('admin.permissions.create-role-model')
    @show 
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/admin/js/permissions/index.js') }}"></script>
@endsection