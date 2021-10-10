@extends('admin.layout.master')

@section('title')
{{ $moduleAction ?? 'Manage Teams' }}
@endsection

@section('styles')
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-xs-12 bundle width-auto-1-column-140">
            <div class="card border-0 shadow">
                <h1 class="title blue-border-bottom">
                    {{ strtoupper($moduleTitle) ?? 'MANAGE CATEGORIES' }}
                </h1>
                <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
                    @can('manage-categories')
                    <a href="#" class="blue-btn ml-auto" data-toggle="modal" data-target="#addCategory" onclick="document.getElementById('categoriesForm').reset()" >Add Category</a>
                    @endcan
                </div>
                <table id="categoryListingTable" class="table last-border-none mb-0 even-odd-row no-border-right vertical-align-middle" style="width:100%" >
                    <thead>
                        <tr>
                            <th class="text-center w-100-px" >Serial No</th>
                            <th class=" w-600-px">Title</th>
                            <th class="w-170-px">Created at</th>
                            <th class="w-130-px">Actions</th>
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
    <script type="text/javascript" src="{{ asset('/assets/admin/js/categories/index.js') }}"></script>
@endsection