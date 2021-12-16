@extends('admin.layout.master')
@section('title')
{{ $moduleAction ?? 'Manage Users' }}
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-xs-12">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
            Welcome Dashboard
            </h1>
            <div class="card-body-15 blue-border-bottom">
                <ul class="notice-lists list-group clear mh-200" id="noticeList">  
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
