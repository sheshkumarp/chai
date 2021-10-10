@extends('web.layout.master')

@section('title')
{{ $moduleAction ?? 'Dashboard' }}
@endsection

@section('styles')
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-xs-12 bundle width-auto-1-column-140">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                {{ strtoupper($moduleTitle) ?? 'MANAGE USERS' }}
            </h1>
            <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom justify-content-end">
                @can('customer-details')
                   
                <a href="{{ route($modulePath.'create') }}" class="blue-btn ml-auto" >Add Customer</a>
                @endcan
                    <form name="frmCustomerDelete" id="frmCustomerDelete" method="post"
                    action="{{ url('/admin/customers/deleteCustomer') }}" onSubmit="return deleteCollection(this)">
                    {{ csrf_field() }}                    
                    <input type="hidden" name="hiddedIds" id="hiddedIds" value="" />
                    @can('customer-details')
                    <button type="submit" class="blue-btn ml-3" id="frm_delete">
                        Delete
                        Selected</button>
                    @endcan
                </form>
            </div>
            <table id="listingTable" class="table mb-0 first-child-border-0 even-odd-row-1 break-word"
                style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align:center;">Sr.no</th>
                        <th style="text-align:center;">Team</th>
                        <th style="text-align:center;">Asset Type</th>
                        <th style="text-align:center;">Equipment Description</th>
                        <th style="text-align:center;">Invoice</th>
                        <th style="text-align:center;">Actions</th>
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
    <script type="text/javascript" src="{{ url('assets/web/js/asset/index.js') }}"></script>
@endsection